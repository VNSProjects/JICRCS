from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.common.by import By
import pandas as pd
import xlwt
import pandas as pd

##wb = xlwt.Workbook()
##sheet = wb.add_sheet("Job Postings",cell_overwrite_ok=True)
##style = xlwt.easyxf('font: bold 1')
##sheet.write(1 ,1, 'Job Title', style)
##sheet.write(1, 2, 'Company Name', style)
##sheet.write(1, 3, 'Exp', style)
##sheet.write(1, 4, 'Location', style)
##sheet.write(1, 5, 'Skills', style)
##sheet.write(1, 6, 'Functional Areas', style)
##sheet.write(1, 7, 'rating', style)
##sheet.write(1, 8, 'Vacancy', style)
##sheet.write(1, 9, 'Employment Type', style)
##wb.save('E:\\Users\\anees\\desktop\\jobs3.xls')
#data=[]

temp=[]
df = pd.DataFrame(columns=['Job Title','Company Name','Exp','Location','skills','Functional Areas','rating','Vacancy','Employment Type'])
dictt={}
pages=''
driver = webdriver.Chrome(r"D:\Code\chromedriver_win32\chromedriver.exe")
#irl=2
for x in range(1,5):
    driver.get('http://www.ambitionbox.com/jobs/search?designation=full-stack-developer&page='+str(x))
    try:
        more_button=driver.find_element_by_css_selector('p.body-medium.chip.more')  ##+5 MORe
        more_button.click()
    except:
        pass
    #try:
##    txt=driver.find_elements_by_class_name('body-small-l')    
##  if 'more' in z.get_attribute('outerHTML'):
##  val = (z.get_attribute('outerHTML')).split('+')[1]    
    #print((driver.find_element(By.XPATH,'//p[text()=+'+val+']')))
    #    print('done')
    #except:
    #    pass
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
        #re=0
        
        
        try:
            #re=int(company)
            name=(soup.find('h1').getText())
            company=(soup.find('h2').getText())
            #print(name,'dssss',company)
        except:
            name=(soup.find('h2').getText())
            company=(soup.find('h3').getText())
            #print(name,'dssss1',company)

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
##        dictt['job_title']=name
##        dictt['com_name']=company
##        dictt['rating']=rating
##        dictt['loc']=loc.strip()
##        dictt['exp']=exp.strip()
##        dictt['vacancy']=vacancy.strip()
##        dictt['skills']=skills
##        dictt['emp_type']=emp_type.strip()
##        dictt['fn_areas']=fn_areas.strip()
        #data.append(dictt)
##        sheet.write(irl , 1, name, style)
##        sheet.write(irl, 2, company, style)
##        sheet.write(irl, 3, exp, style)
##        sheet.write(irl, 4, loc, style)
##        sheet.write(irl, 5, skills, style)
##        sheet.write(irl, 6, fn_areas.strip(), style)
##        sheet.write(irl, 7, rating, style)
##        sheet.write(irl, 8, vacancy.strip(), style)
##        sheet.write(irl, 9, emp_type.strip(), style)

        #print(name,company,exp,loc,skills,fn_areas,rating,vacancy,emp_type)
        temp.append([name,company,exp,loc,skills,fn_areas.strip(),rating,vacancy,emp_type.strip()])
        #print(temp)
        name=''
        company=''
        exp=''
        loc=''
        rating=''
        vacancy=''
        
        #wb.save('E:\\Users\\anees\\desktop\\jobs3.xls')
        #print(dictt)
        #irl+=1
        pages=''
        #dictt.clear()
    df = pd.DataFrame(temp,columns=['Job Title','Company Name','Exp','Location','skills','Functional Areas','rating','Vacancy','Employment Type'])
    ##df.to_csv('D:\\Project Data\\FSD2.csv')    
##print(data)
