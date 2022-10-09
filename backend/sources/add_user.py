import pandas as pd
import numpy as np
import sys

###########################################JOB########################################################

f = open(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\jobs_ratings.csv')
csv_input = pd.read_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\jobs_ratings.csv',index_col="jobs_id")
user = sys.argv[1]
# print(user)
csv_input[user] = ''
csv_input.to_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\jobs_ratings.csv')
# print(csv_input)
# df = pd.read_csv(r"E:\\xampp\\htdocs\\JICRCS\\BackEnd\\sources\\output.csv")
f.close()
###########################################INTERNSHIP########################################################

f = open(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\internships_ratings.csv')
csv_input = pd.read_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\internships_ratings.csv',index_col="ints_id")
user = sys.argv[1]
# print(user)
csv_input[user] = ''
csv_input.to_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\internships_ratings.csv')
# print(csv_input)
# df = pd.read_csv(r"E:\\xampp\\htdocs\\JICRCS\\BackEnd\\sources\\output.csv")
f.close()

###########################################COURSE########################################################

f = open(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\courses_ratings.csv')
csv_input = pd.read_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\courses_ratings.csv',index_col="course_id")
user = sys.argv[1]
print(user)
csv_input[user] = ''
csv_input.to_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\courses_ratings.csv')
# print(csv_input)
# df = pd.read_csv(r"E:\\xampp\\htdocs\\JICRCS\\BackEnd\\sources\\output.csv")
f.close()




