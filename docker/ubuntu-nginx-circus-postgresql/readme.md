# Short Description
All-in-One Web(Python3)開発環境 （Ubuntu + Nginx(ssl) + Python3 + Circus + Django + RabbitMQ + Node + Coffee + Redis + PostgreSQL）

# Full Description

## ● [Dockerfileは、こちら(GitHub)](https://github.com/maemori/accon/blob/master/docker/ubuntu-nginx-circus-postgresql/Dockerfile)

## ● [Dockerfile一式は、こちらからダウンロード](https://kurobuta.jp/download/get/18)

-----

## 1. 概要

PythonのWebアプリケーションに特化したローカル開発環境。  
ローカルPCの開発用ディレクトリをDockerコンテナと共有し、そのUbuntu上で実行・開発・デバッグを行うための環境。

## 2. 構成バージョン

 * Ubuntu: 16.10 LTS (日本語対応)
 * Nginx: 1.10
 * Python3: 3.5.2
 * Circus: 0.14.0
 * Django: 1.10.6
 * RabbitMQ: 3.5.7
 * Node: 7.7.4
 * coffee: 1.12.4
 * Redis: 3.2
 * PostgreSQL: 9.5.6

## 3. 利用方法

### 3.1. ローカルPCにDockerコンテナと共有するディレクトリを作成(workspacとwwwの配置場所は任意)

```bash:
mkdir ~/productment
mkdir -p ~/productment/ubuntu-nginx-circus-postgresql/workspace
mkdir ~/productment/ubuntu-nginx-circus-postgresql/www
```

### 3.2. Dockerコンテナの取得と起動

```bash:
docker run -d \
  -v ~/productment/ubuntu-nginx-circus-postgresql/workspace:/develop/workspace:rw \
  -v ~/productment/ubuntu-nginx-circus-postgresql/www:/develop/www:rw \
  -p 80:80 -p 443:443 -p 5432:5432 -p 15672:15672 \
  -t -i \
  -h develop-server-01 \
  --name develop-server-01 \
  accon/ubuntu-nginx-circus-postgresql:1.01
```

PORT  
 * 80 : http - [http://localhost](http://localhost)
 * 443 : https - [https://localhost](https://localhost)
 * 5432 : PostgreSQL
 * 15672 : RabbitMQ - [http://localhost:15672/](http://localhost:15672/)

### 3.3. 動作確認用ファイルの設置

~/public/data-volume/wwwディレクリ配下にindex.phpファイルを配置。

```
echo "TEST OK." >  ~/development/www/index.html
```

#### 3.4. 動作確認

下のURLにアクセスしPHPの情報が表示されればOK。

* [http://127.0.0.1](http://127.0.0.1)
* [https://127.0.0.1](https://127.0.0.1)

## 4. よく使うDockerコンテナを制御するコマンド

* コンテナのコンソールに接続

```bash:
docker exec -it develop-server-01 bash
```

* コンテナのスタート

```bash:
docker start develop-server-01
```

* コンテナのストップ

```bash:
docker stop develop-server-01
```

* コンテナの削除

```bash:
docker rm develop-server-01
```

* 起動中コンテナの確認

```bash:
docker ps
```

* 全てのコンテナの確認

```bash:
docker ps -a
```

* コンテナイメージの一覧

```bash:
docker images
```

-----

## 5. 利用例

### 5.1. [Dockerfile:TAIGA](https://github.com/maemori/accon/tree/master/docker/taiga)

-----

## X. コンテナ開発者向け

### X.1. Dockerコンテナイメージの管理

#### X.1.1. ビルド

```bash:
cd ~/Develop/master/accon/v2.0/data-volume/workspace/accon/docker/ubuntu-nginx-circus-postgresql/
docker build -t accon/ubuntu-nginx-circus-postgresql:1.01 .
```

----

#### X.1.2. レポジトリにプッシュ

```bash:
# push
docker push accon/ubuntu-nginx-circus-postgresql:1.01
# Tag
docker tag accon/ubuntu-nginx-circus-postgresql:1.01 accon/ubuntu-nginx-circus-postgresql:latest
docker push accon/ubuntu-nginx-circus-postgresql:latest
# None images delete
docker images | awk '/<none/{print $3}' | xargs docker rmi
docker images
```

#### X.1.3. コンテナイメージの削除

```
docker rmi accon/ubuntu-nginx-circus-postgresql:latest
docker rmi accon/ubuntu-nginx-circus-postgresql:1.00
```
