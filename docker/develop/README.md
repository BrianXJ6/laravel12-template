# Ambiente de desenvolvimento

## Dockerfile

Revisar pacotes esseciais:

- fswatch
- dnsutils
- gnupg
- autoconf

Reviser extensões PHP:

[PECL] Instaladas via comando `pecl install <ext>` e para habilitar `docker-php-ext-enable <ext>`

- php8.4-msgpack (útil para transmissão de dados entre sistemas, como no contexto de APIs ou aplicações que precisam trocar informações em tempo real)
- php8.4-igbinary (serialização/deserialização de alta eficiência)
- php8.4-swoole (Otimização de servidor single thds)
- php8.4-imap (SMTP)

[VÁLIDAS]
facilmente instalada com `docker-php-ext-install`

- php8.4-bcmath (oferece suporte para operações matemáticas de precisão arbitrária)
- php8.4-soap (Ferramenta para mensagens estruturadas em XML)
- php8.4-intl (Manipula e processa informações relacionadas à internacionalização (i18n). útil para formatação de números, datas e moedas, manipulação de strings)
- php8.4-ldap (Conectem-se a Servidores LDAP, atuh e etc)

[INVÁLIDAS]
solução desconhecida...

- php8.4-cli
- php8.4-dev

## Supervisor

Revisar supervisão de serviço para SSR

```bash
[program:ssr]
autostart=false
autorestart=false
command=/usr/bin/php /var/www/html/artisan inertia:start-ssr
stdout_logfile=/dev/stdout
stdout_logfile_maxbytes=0
stderr_logfile=/dev/stderr
stderr_logfile_maxbytes=0
```
