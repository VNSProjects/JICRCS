import pandas as pd
import numpy as np
import sys
import mysql.connector

mydb = mysql.connector.connect(host="localhost",user="root",password="",database="JICRCS")
mycursor = mydb.cursor()

name = sys.argv[1]

df=pd.read_csv(r"E:\\xampp\\htdocs\\JICRCS\\BackEnd\data\\courses_ratings.csv", index_col=['course_id', 'course_title', 'url', 'level', 'subject'])
#df.head()
# df_courses = pd.read_csv("../Data/courses_dataset.csv")
#df_courses.head()
df = df.fillna(0).astype(int)
#df.head()
from sklearn.neighbors import NearestNeighbors
knn = NearestNeighbors(metric='cosine', algorithm='brute')
knn.fit(df.values)
distances, indices = knn.kneighbors(df.values, n_neighbors=3)
df1 = df.copy()

def recommend_courses(user, num_recommended_course):
    recommended_course = []

    for m in df[df[user] == 0].index.tolist():
        index_df = df.index.tolist().index(m)
        predicted_rating = df1.iloc[index_df, df1.columns.tolist().index(user)]
        recommended_course.append((m, predicted_rating))

    sorted_rm = sorted(recommended_course, key=lambda x:x[1], reverse=True)

    #print('The list of the Recommended course \n')
    rank = 1
    recommandations = list()
    for recommended_course in sorted_rm[:num_recommended_course]:
        recommandations.append(recommended_course[0])
        #print('{}: {} - predicted rating:{}'.format(rank, recommended_course[0], recommended_course[1]))
        rank = rank + 1
    return recommandations
recommendations = recommend_courses(name, 20)
# print(recommendations[0][0])
# print(recommendations[0][1])
# print(recommendations[0][2])
# print(recommendations[0][3])

for i in range(0,len(recommendations)):
    mycursor.execute("CREATE TABLE IF NOT EXISTS CoursesCollab (id VARCHAR(255), title VARCHAR(255),\
        url VARCHAR(255), subject VARCHAR(255))")
    
    sql = "INSERT INTO CoursesCollab (id, title, url, subject) VALUES (%s,%s,%s,%s)"
    val = (recommendations[i][0],recommendations[i][1],recommendations[i][2],recommendations[i][4])
    #print(val)
    mycursor.execute(sql,val)
    mydb.commit()
    #print(mycursor.rowcount, "record inserted.")

    

