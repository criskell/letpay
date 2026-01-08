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

## Decisões técnicas e suas motivações

-   Criar o pagamento mesmo que os providers falhem
    -   Para manter a possibilidade idempotência de pagamentos rastreados internamente.
-   Separação entre lógica de negócio e camada de apresentação.
    -   Evita duplicação de lógica de negócio potencialmente levando a bugs.
    -   Melhora a legibilidade e manutebilidade do código.
-   Cada provider provém uma interface HTTP que adapta o formato de webhooks dos providers para o formato de webhook interno.
    -   Com isso, podemos reutilizar a mesma lógica de processamento para diferentes providers.
