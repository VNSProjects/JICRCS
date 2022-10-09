import pandas as pd
import sys

id = sys.argv[1]
#print(type(id))
name = sys.argv[2]
rating = sys.argv[3]
f = open(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\jobs_ratings.csv')
df = pd.read_csv(r"E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\jobs_ratings.csv",index_col="jobs_id") 

df.loc[int(id), name] = rating
df.to_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\jobs_ratings.csv')

# print("run")
f.close()