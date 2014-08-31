# LAB PKC - Criptossistemas de chaves assimétricas

## Prólogo

  - Utilize _openssl_ para realizar operações criptográficas.
  - Utilize AES-128 e o RSA-3072 como cifras simétrica e assimétrica, 
    respectivamente.
  - Utilize validade de 365 dias para gerar certificados. 
  - Utilizar a seguinte chave simétrica: ```echo 'andre' | hexdump -e '"%02X"'; echo```
    ou ```72646e61a65```.

## Ex. 1: Criação de AC

  1. Gere um par de chaves de cifra assimétrica e cifre o resultado usando uma 
     cifra simétrica.
    ```
      openssl genrsa -aes128 -out keys/andre-key.pem 3072
      pass phase: 72646e61a65
    ```

  2. Gere um certificado auto-assinado.
    ```
      openssl req -new -x509 -key keys/andre-key.pem -out certs/andre-cert.pem -days 365
      pass phrase: ...
      BR
      Minas-Gerais
      Belo-Horizonte
      andre
      andre
      andre
      taiar@dcc.ufmg.br
    ```

## Ex. 2: Criação de usuário

  1. Gere um par de chaves de cifra assimétrica e cifre o resultado usando uma 
     cifra simétrica.

     ```
       openssl genrsa -aes128 -out keys/andre-key.pem 3072
       pass phase: 72646e61a65
     ```

  2. Gere uma requisição de certificado.

    ```
      openssl req -new -key keys/andre-key.pem -out reqs/andre-req.pem -days 365
    ```

  3. Solicite para que a AC assine (a rquisição de) o certificado.

    ```
      openssl x509 -req -in reqs/andre-req.pem -CA certs/andre-cert.pem -CAkey keys/andre-key.pem -CAcreateserial -out certs/candre-cert.pem
      Signature ok
      subject=/C=BR/ST=Minas-Gerais/L=Belo-Horizonte/O=andre/OU=andre/CN=andre/emailAddress=taiar@dcc.ufmg.br
      Getting CA Private Key
      Enter pass phrase for keys/andre-key.pem:
    ```

## Ex. 3: Verificação de certificado

  1. Submeta o certificado de um usuário à uma verificação.
    1. Quais dados você precisa para tal verificação?
    2. Quais os comandos utilizados?
    3. Qual a duração dos comandos utilizados?