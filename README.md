# Comp3335-group15
Database security

This project is using Apache, MySql 8.0, PhpMyAdmin, PHP 7.4, Prometheus, mysqld-exporter and Grafana

The application using ONLINE_SALES_WEBSITE
[https://github.com/shravasam/ONLINE_SALES_WEBSITE](https://github.com/shravasam/ONLINE_SALES_WEBSITE)


Demo video (YouTube)
https://youtu.be/Hb4HQo_mysI

----
# Setup the application

1. Clone the repository
```
git clone https://github.com/lossfuture/comp3335-group15/
```
2. cd into folder

3. Docker Compose after pull 
```
docker-compose up -d
```
4. Start up the container by using docker-compose as follows.
```
docker-compose up
```
5. Open another shell. Check the running containers:
```
docker ps
```
6. then type localhost:8000 for phpmyadmin and  localhost:8001 for web server, to check where it is successful

----
# Login to the application
7. Go to login page, and using email to sign up

8. Real email is needed because we adpoted email verification

9. Then login to system

10. A one-time access code has been sent into email, type it.

11. Successful login to the system

----
# Admin Panel in the application
12. Go to /admin/ and login, username can be kenny or harry, password is same as the username.

13. Due to demo reason, 2FA is not adopted here.

14. You can work around the product and user deleteion

----
# Manager Panel in the application
12. Go to /manager/login-form.php and login, username can be charlie or samuel, password is same as the username.

13. Due to demo reason, 2FA is not adopted here.

14. You can work around the vailate the products

----
# Monitoring the database
1. Go to Prometheus using port 9090

run a particular query:
> click on Graph 
> click on insert metric: select the query in the drop-down menu that you want to execute 
> click on the execute button.


2. using Grafana login (port 9876) 
```
Username: admin
Password: admin
```
Click Skip

3.Add the data source(Set Prometheus as Grafana data source)

URL: http://prometheus:9090/

Enter the URL and click on Save & Test.

4.On the left menu, click on the plus icon and click on import


> Enter 7362 
> click Load button
> Select prometheus
> Click Import

Finally, your dashboard will be imported with real-time updates of MySQL.


----
# Shuting down the application
1. shut down by press control-C
---




----
References :

ONLINE_SALES_WEBSITE
[https://github.com/shravasam/ONLINE_SALES_WEBSITE](https://github.com/shravasam/ONLINE_SALES_WEBSITE)

Simple blog (for PHP PDO)
[https://github.com/dcblogdev/simple-blog-part-1-build](https://github.com/dcblogdev/simple-blog-part-1-build)

LAMP Stack with docker
[https://polyu-comp.gitbook.io/lamp-stack-with-docker/](https://polyu-comp.gitbook.io/lamp-stack-with-docker/)


