# Đồ án đa nghành HCMUT - HK 242

# TechStack
 ```
 PHP
 LARAVEL
 VUEJS
 YOLO:BITS
 ADAFRUIT
 ```


## ⚙️ Run project `.env`

```
Yêu cầu cài Docker + Node

Tạo file .env ở src folder
Copy toàn bộ file .env.example  qua .env

Tạo file .env ở frontend folder(nếu chưa có)
Copy toàn bộ file .env.example  qua .env


```


## Setup docker + backend

```
Chạy theo từng lệnh
1. docker-compose build
2. docker-compose up -d
3. docker-compose exec app bash 
4. composer install
5. php migrate 
 
```





## Setup frontend

```
    cd frontend
    npm install
    npm run dev
```


## Access
```
Frontend : localhost:5173
Backend : localhost:8081/api
```

## Sau khi setup mỗi lần chạy 

```
    docker-compose up -d
    cd frontend
    npm run dev
```