# README

## protoc

### alpine 

```shell
apk add protobuf
```

### debian
```
apt install -y protobuf-compiler
```

### 验证 protoc 是否安装成功

```shell
protoc --version
```

### 使用 protoc 生成代码

```shell
protoc --php_out=../grpc/ user.proto
```

## composer

```shell
composer require google/protobuf
```


