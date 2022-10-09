import pandas as pd

f = open(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\sources\\output.csv')
# csv_input = pd.read_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\courses_ratings.csv')
# csv_input['BBA'] = ''
# csv_input.to_csv('output.csv', index=False)

# def func1():
# csv_input = pd.read_csv(r'E:\\xampp\\htdocs\\JICRCS\\BackEnd\\data\\courses_ratings.csv')
# csv_input['Berriessdfssdfsdsgdfg'] = ''
# csv_input.to_csv('output.csv', index=False)



# # def func2():
df = pd.read_csv(r"E:\\xampp\\htdocs\\JICRCS\\BackEnd\\sources\\output.csv",index_col="course_id") 

# updating the column value/data
df.loc[1070968, 'Ramesh'] = 'SHIV asdadas'
df.loc[1011058, 'Sonal'] = 'SHIV asda'
df.loc[1210588, 'Berriessdfssdfsdsgdfg'] = 'CHANDRAs dfdg'


#     # writing into the file
df.to_csv("output.csv")
# df = pd.read_csv(r"E:\\xampp\\htdocs\\JICRCS\\BackEnd\\sources\\AllDetails.csv")
# print(df)

f.close()

# reading the csv file
# if __name__=="__main__":
    # func1()
    # func2()

#print(df)