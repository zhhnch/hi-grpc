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

## protobuf-compiler-grpc

```shell
sudo apt install -y protobuf-compiler-grpc
```

### 验证 protoc 是否安装成功

```shell
protoc --version
```

### 使用 protoc 生成代码

```shell
protoc --php_out=../grpc/ user.proto
```

```shell
protoc --proto_path=proto/ --php_out=grpc/ proto/*.proto
```

```shell
protoc --proto_path=proto/ \
  --php_out=grpc/ \
  --grpc_out=grpc/ \
  --plugin=protoc-gen-grpc=/usr/bin/grpc_php_plugin \
  proto/*.proto
```

## composer

```shell
composer require google/protobuf
```


## JsonRpc

```shell
curl -d '{"jsonrpc": "2.0", "method": "/app/detail", "params": ["382210404157267968"], "id": 1}' http://localhost:9505
```