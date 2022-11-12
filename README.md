# Comp3335-group15
database security

Reference: [https://polyu-comp.gitbook.io/lamp-stack-with-docker/](https://polyu-comp.gitbook.io/lamp-stack-with-docker/)

Since the example contains  Apache, MySql 8.0, PhpMyAdmin and Php 7.3

VS Code extension
[https://marketplace.visualstudio.com/items?itemName=github.remotehub](https://marketplace.visualstudio.com/items?itemName=github.remotehub)

1. Clone the repository
```
git clone https://github.com/lossfuture/comp3335-group15/
```
2. cd into folder

3. Docker Compose after pull 
```
docker-compose up -d
```

3. Start up the container by using docker-compose as follows.
```
docker-compose up
```
4. Open another shell. Check the running containers:
```
docker ps
```
5. then type localhost:8000 for phpmyadmin and  localhost:8001 for php file, to check where it is successful

6. shut down by press control-C
---
# Run linux script reference

Add command on Dockerfile

e.g. 

edit mysql root password,

force password changes, etc.

[https://ithelp.ithome.com.tw/articles/10191016?sc=hot](https://ithelp.ithome.com.tw/articles/10191016?sc=hot)
