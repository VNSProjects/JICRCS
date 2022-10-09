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
    sim_scores = list(enumerate(cosine_sim[idx]))
    sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)
    job_indices = [i[0] for i in sim_scores]
    return indices.iloc[job_indices], job_indices

if __name__ == "__main__":
    df_skills = pd.read_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\skills.csv', usecols=['skills'])
    main_df = pd.read_csv(r'E:\\\xampp\\htdocs\\JICRCS\\BackEnd\data\\jobs_recommends.csv', index_col='Index')
    indices = pd.read_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\skills_indices.csv')
    indices = pd.Series(indices.index, index=indices['skills'])

    with open(r"E:\\xampp\\htdocs\\JICRCS\\BackEnd\\models\\tfidf_vectorizer_skills.pickle", "rb") as f:
        tfidf_matrix = pickle.load(f)
    input_skill = sys.argv[1]
    #print(input_skill)
    email = sys.argv[2]
    #print(email)
    recommandations, job_indices = get_recommandation(input_skill, tfidf_matrix, df_skills, indices)
    #print(recommandations.shape, type(recommandations), recommandations.index.tolist())
    #print(df_skills.iloc[job_indices, :])

    #print(main_df.iloc[job_indices, :].head(20))
    final = main_df.iloc[job_indices, :].head(20)
    final = final.fillna("null")
    final_list = final.values.tolist()
    #print(len(final_list))
    for i in range(0,len(final_list)):
        mycursor.execute("CREATE TABLE IF NOT EXISTS JobsR (id VARCHAR(255), jobstitle VARCHAR(255),\
        companyname VARCHAR(255),exp VARCHAR(255),\
        location VARCHAR(255),skills VARCHAR(255),\
        functionalArea VARCHAR(255),rating VARCHAR(255),\
        vacany VARCHAR(255),empType VARCHAR(255),\
        description VARCHAR(255),benef VARCHAR(255))")

        sql = "INSERT INTO JobsR (id, jobstitle,companyname,exp,location,skills,functionalArea,rating,vacany,empType,description,benef) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
        val = (final_list[i][0],final_list[i][1],final_list[i][2],final_list[i][3],final_list[i][4],final_list[i][5],final_list[i][6],final_list[i][7],final_list[i][8],final_list[i][9],final_list[i][10],final_list[i][11])
        mycursor.execute(sql,val)
        mydb.commit()
        #print(mycursor.rowcount, "record inserted.")

        # print(final_list[i][0])
        # print(final_list[i][1])
        # print(final_list[i][2])
        # print(final_list[i][3])
        # print(final_list[i][4])
        # print(final_list[i][5])
        # print(final_list[i][6])
        # print(final_list[i][7])
        # print(final_list[i][8])
        # print(final_list[i][9])









        
        
