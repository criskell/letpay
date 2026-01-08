# letpay

Gateway de pagamento para diferentes provedores de pagamentos.

## Funcionalidades

-   Roteamento de pagamentos
-   Multiprovider
-   Idempotência
-   Múltiplos métodos de pagamento

## Como rodar?

A forma mais fácil é ter o Docker e Docker Compose instalados, pois esse projeto foi construído com Laravel Sail:

```bash
composer install
./vendor/bin/sail up
```

## Endpoints

### Autenticação

#### Login

`POST` /auth/login

Campos:

-   `email`: E-mail do usuário.
-   `password`: Senha do usuário.

Exemplo de corpo:

```json
{
    "email": "oi@criskell.com",
    "password": "123456789"
}
```

#### Registro

`POST` /auth/register

Campos:

-   `name`: Nome do usuário.
-   `email`: E-mail do usuário.
-   `password`: Senha do usuário.

Exemplo de corpo:

```json
{
    "name": "criskell",
    "email": "oi@criskell.com",
    "password": "123456789",
    "password_confirmation": "123456789"
}
```

## Perfil

### Obter perfil

`GET` `/api/profile`

Retorna os dados do usuário autenticado.

**Rota protegida.**

## Pagamentos

### Criar pagamento

`POST` `/api/payments`

Exemplo de corpo:

```json
{
    "amount": 1,
    "method": "PIX"
}
```

## Webhooks

### Notificar que o pagamento foi recebido (provider TEST)

`POST` `/api/webhooks/providers/test`

Exemplo de corpo:

```json
{
    "correlation_id": "019b9d0b-fae4-737f-b6ac-ea4545be91ff"
}
```

## Decisões técnicas e suas motivações

-   Criar o pagamento mesmo que os providers falhem
    -   Para manter a possibilidade idempotência de pagamentos rastreados internamente.
-   Separação entre lógica de negócio e camada de apresentação.
    -   Evita duplicação de lógica de negócio potencialmente levando a bugs.
    -   Melhora a legibilidade e manutebilidade do código.
-   Cada provider provém uma interface HTTP que adapta o formato de webhooks dos providers para o formato de webhook interno.
    -   Com isso, podemos reutilizar a mesma lógica de processamento para diferentes providers.
