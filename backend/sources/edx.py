from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.common.by import By
import pandas as pd
import xlwt
import pandas as pd

temp=[]
df = pd.DataFrame(columns=['Job Title','Company Name','Exp','Location','skills','Functional Areas','rating','Vacancy','Employment Type', 'Description', 'Benefits'])
dictt={}
pages=''
driver = webdriver.Chrome(r"D:\Code\JICRS\chromedriver\chromedriver.exe")

for x in range(1,5):
    driver.get('https://www.edx.org/search?q=python&tab=course')
    try:
        print("-----------page----1-------")        
        more_button=driver.find_element_by_css_selector('button.btn-icon.btn-icon-primary.btn-icon-md.next.page-link')
        print("-----------page------2-----")
        print(more_button)
        more_button.click()
        #print("-----------page-----------")
        print(more_button.click())
    except:
        #print("-----------page-----------")
        pass


