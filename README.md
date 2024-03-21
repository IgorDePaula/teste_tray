Teste Tray
==========

Teste PHP Sênior para a empresa Tray

Requisitos:

- Make
- Docker

Passos para levantar o projeto:

1- Copie o ```.env.example``` para ```.env``` e mude as credenciais do banco, podendo utilizar as credenciais default.

2- Digite no terminal ```make docker-install``` e dê Enter, para buildar a imagem.

3- Digite no terminal ```make docker-migrate``` e dê Enter, para criar o banco.

4- Digite no terminal ```make docker-up``` e dê Enter, para levantar o projeto.

Testes
------

- Digite no terminal ```make docker-test``` e dê Enter, para realizar os testes unitarios.
- Digite no terminal ```make docker-coerage``` e dê Enter, para verificar a cobertura de código.


API
---

Para acessar a documentação da API, consulte [este documento da openapi](docs/api.json).
