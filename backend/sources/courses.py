import pandas as pd
import numpy as np
import warnings
warnings.filterwarnings('ignore')
import nltk
import string
from ast import literal_eval
from sklearn.feature_extraction.text import TfidfVectorizer, CountVectorizer
from sklearn.metrics.pairwise import linear_kernel, cosine_similarity
from fuzzywuzzy import process, fuzz
import pickle
import sys
import mysql.connector

mydb = mysql.connector.connect(host="localhost",user="root",password="",database="JICRCS")
mycursor = mydb.cursor()

def get_recommandation(input_skills, tfidf_matrix, df_skills, indices):
    cosine_sim = linear_kernel(tfidf_matrix, tfidf_matrix)
    idx = indices[process.extractOne(input_skills.lower(), indices.index, scorer=fuzz.token_sort_ratio)[0]]
    
    #     print("idx:", idx)
#     print(type(idx))
    
    if isinstance(idx, pd.Series):
#         print("series")
        idx = idx[0]
#         print(idx, type(int(idx)))
    
#     if type(idx) is series:
#         idx = idx[0]
        
#     print(idx)
    
    sim_scores = list(enumerate(cosine_sim[idx]))
    sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)
    job_indices = [i[0] for i in sim_scores]
    return indices.iloc[job_indices], job_indices

if __name__ == "__main__":
    df_skills = pd.read_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\course_title.csv', usecols=['course_title'])
    main_df = pd.read_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\data\\courses_recommends.csv', index_col='Index')
    indices = pd.read_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\course_title_indices.csv')
    indices = pd.Series(indices.index, index=indices['course_title'])

    with open(r"E:\\xampp\\htdocs\\JICRCS\\BackEnd\\models\\tfidf_vectorizer_course_title.pickle", "rb") as f:
        tfidf_matrix = pickle.load(f)
    input_skill = sys.argv[1]
    email = sys.argv[2]
    recommandations, job_indices = get_recommandation(input_skill, tfidf_matrix, df_skills, indices)
    #print(recommandations.shape, type(recommandations), recommandations.index.tolist())
    #print(df_skills.iloc[job_indices, :])
    final = main_df.iloc[job_indices, :].head(20)
    final = final.fillna("null")
    final_list = final.values.tolist()

    for i in range(0,len(final_list)):
        mycursor.execute("CREATE TABLE IF NOT EXISTS courseR (id VARCHAR(255),\
        title VARCHAR(255),uni VARCHAR(255),\
        course VARCHAR(255),ratings VARCHAR(255),\
        type VARCHAR(255),noofpeoplerated VARCHAR(255))")

        # print(final_list[i][2])

        sql = "INSERT INTO courseR (id, title,uni,course,ratings,type,noofpeoplerated) VALUES (%s,%s,%s,%s,%s,%s,%s)"
        val = (final_list[i][0],final_list[i][1],final_list[i][2],final_list[i][3],final_list[i][4],final_list[i][5],final_list[i][6])
        mycursor.execute(sql,val)
        mydb.commit()



        # print(final_list[i][0])
        # print(final_list[i][1])
        # print(final_list[i][2])
        # print(final_list[i][3])
        # print(final_list[i][4]) 
        # print(final_list[i][5])
        # print(final_list[i][6])
        