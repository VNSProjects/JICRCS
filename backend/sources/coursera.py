from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.common.by import By
import pandas as pd
import xlwt
import pandas as pd

temp=[]

df = pd.DataFrame(columns=['title', 'institute', 'ratings out of 5', 'type', 'level', 'link'])

pages=''

driver = webdriver.Chrome(r"..\\chromedriver\\chromedriver.exe")

for x in range(1,2):

    #print('https://www.coursera.org/search?query=java&page='+str(x))
    driver.get('https://www.coursera.org/search?query=java&page='+str(x))

    divs = driver.find_elements_by_class_name('card-info')
    for index in range(1, len(divs)):
        element = divs[index].get_attribute('outerHTML')
        soup = BeautifulSoup(element,'html.parser')
        #print(soup.text)
        
        title=''

        try:
            title=((soup.find('h3', attrs={'class': 'card-title'})).getText()).strip()
        except:
            pass        

        institute = ''

        spans = soup.find('span', attrs={'class': 'partner-name'})
        for tag in spans:            
            institute=(tag.text.strip())
        
        ratings = ''
        spans = soup.find('span', attrs={'class': 'ratings-text'})
        for tag in spans:            
            ratings = (tag.text.strip())

        typel = ''   
        
        spans = soup.find('span', attrs={'class': 'pillContainer'})
        for tag in spans:            
            typel = (tag.text.strip())

        level = ''
        spans = soup.find('span', attrs={'class': 'difficulty'})
        for tag in spans:            
            print(tag.text.strip())
        '''
        link = ''
        url = 'https://internshala.com/'
        a = soup.find('a')
        #print(a.get('href'))

        spans = soup.find('a')
        for tag in spans:
            print(a.get('href'))

        
        try:
            path = ((a.get('href'))
            link = url + path
        except:
            pass
        '''
        temp.append([title, institute, ratings, typel, level, link])

        #print(temp[index-1])

    title = ''
    institute = ''
    ratings = ''
    typel = ''
    level = ''
    link = ''

    df = pd.DataFrame(temp, columns = ['title', 'institute', 'ratings out of 5', 'type', 'level', 'link'])
    df.to_csv('..\\data\\internshala.csv')