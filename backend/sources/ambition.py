from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.common.by import By
import pandas as pd
import xlwt
import pandas as pd

temp=[]

df = pd.DataFrame(columns=['Job Title','Company Name','Exp','Location','skills','Functional Areas','rating','Vacancy','Employment Type', 'Description', 'Benefits'])

pages=''

driver = webdriver.Chrome(r"..\\chromedriver\\chromedriver.exe")

for x in range(1,2):

    #print('http://www.ambitionbox.com/jobs/search?designation=full-stack-developer&page='+str(x))
    driver.get('http://www.ambitionbox.com/jobs/search?designation=full-stack-developer&page='+str(x))
    
    try:
        more_button=driver.find_element_by_css_selector('p.body-medium.chip.more')
        more_button.click()
    except:
        pass

    index = 0
    while True:
        divs = driver.find_elements_by_class_name('jobInfoCard')
        try: 
           divs[index].click()
        except IndexError:
           break
        except:
            pass
        c=driver.find_element_by_css_selector('.jdCont')
        d=c.get_attribute('outerHTML')
        pages=d
        index+=1
        soup = BeautifulSoup(pages, 'html.parser')
        #print(soup)
        name=''
        company=''
        exp=''
        loc=''
        rating=''
        vacancy=''        
        
        
        try:            
            name=(soup.find('h1').getText())
            company=(soup.find('h2').getText())
            
        except:
            name=(soup.find('h2').getText())
            company=(soup.find('h3').getText())
            

        try:
            exp=(((soup.findAll("p", {"class": "body-small-l"}))[0]).getText()).strip()
        except:
            pass

        try:
            loc=(((soup.findAll("p", {"class": "body-small-l"}))[2]).getText()).strip()
        except:
            pass

        try:
            if 'vacancy' in ((soup.findAll("p", {"class": "body-small-l"}))[3]).getText():
                vacancy=(((soup.findAll("p", {"class": "body-small-l"}))[3]).getText()).strip()
        except:
            pass

        try:
            rating = ((soup.findAll("span", {"class": "body-medium"}))[0]).getText()
        except:
            pass
        
        
        skills=''
        emp_type=''
        fn_areas=''
        for j in (soup.findAll("a", {"class": "body-medium chip"})):
            skills+=','+(j.getText().strip())
        for i in (soup.findAll("p",{"class": ""})):
            
            if 'Employment Type:' in i.getText():
                emp_type=i.getText().split(':')[1]
            elif 'Functional Areas:' in i.getText():
                fn_areas=i.getText().split(':')[1]
        
        description=''
        benefits=''
        
        #print("------------------ Page " + str(x) + " ---- Card "+ str(index) +" ------------------------")

        try:
            description = ((soup.find("div", {"class": "htmlCont"})).getText()).strip()            
        except:
            pass
        
        try:
            benefits = ((soup.find("div", {"class": "benefits-wrap"})).getText()).strip()           
        except:
            pass
        
        
        #print(name,company,exp,loc,skills,fn_areas,rating,vacancy,emp_type)
        temp.append([name,company,exp,loc,skills,fn_areas.strip(),rating,vacancy,emp_type.strip(),description,benefits])
        #print(temp)
        name=''
        company=''
        exp=''
        loc=''
        rating=''
        vacancy=''
        
        pages=''
        
    df = pd.DataFrame(temp,columns=['Job Title','Company Name','Exp','Location','skills','Functional Areas','rating','Vacancy','Employment Type', 'Description', 'Benefits'])
    df.to_csv('..\\data\\ambition.csv')
    #print(data)
    
