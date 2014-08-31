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
      openssl genrsa -aes128 -out keys/empresa-key.pem 3072
      pass phase: 72646e61a65
    ```

  2. Gere um certificado auto-assinado.
    ```
      openssl req -new -x509 -key keys/empresa-key.pem -out certs/empresa-cert.pem -days 365
      pass phrase: ...
      BR
      Minas-Gerais
      Belo-Horizonte
      empresa
      empresa
      empresa
      empresa@empresa.com.br
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
      pass phrase: ...
      BR
      Minas-Gerais
      Belo-Horizonte
      andre
      andre
      andre
      taiar@dcc.ufmg.br
      andre
      andre
    ```

  3. Solicite para que a AC assine (a rquisição de) o certificado.

    ```
      openssl x509 -req -in reqs/andre-req.pem -CA certs/empresa-cert.pem -CAkey keys/empresa-key.pem -CAcreateserial -out certs/andre-cert.pem
      Signature ok
      subject=/C=BR/ST=Minas-Gerais/L=Belo-Horizonte/O=andre/OU=andre/CN=andre/emailAddress=taiar@dcc.ufmg.br
      Getting CA Private Key
      Enter pass phrase for keys/empresa-key.pem: ...
    ```

## Ex. 3: Verificação de certificado

  1. Submeta o certificado de um usuário à uma verificação.
    1. Quais dados você precisa para tal verificação?

      ```
        Precisamos do certificado do usuário e do certificado da CA (instituição de confiança).
      ```
      
    2. Quais os comandos utilizados?

      ```
        openssl verify -CAfile certs/empresa-cert.pem certs/andre-cert.pem
        certs/andre-cert.pem: C = BR, ST = Minas-Gerais, L = Belo-Horizonte, O = andre, OU = andre, CN = andre, emailAddress = taiar@dcc.ufmg.br
        OK
      ```

    3. Qual a duração dos comandos utilizados?
      
      ```
        user  0m0.012s
        sys 0m0.004s
      ```
