# ONESIGHT TEST

### 1. Resumo

Projeto desenvolvido durante processo seletivo para vaga de desenvolvedor PHP&Vue junior.

O projeto desenvolvido no repositório é um gerenciador de tarefas simples: cada usuário
pode criar tarefas, marcar como completadas e/ou editar/apagar as mesmas.

Como o escopo do projeto foi amplo e ficou a cargo do candidato, optei por trabalhar 
com entidades simples, dessa forma pude economizar tempo com a menor complexidade e
também mostrar minhas habilidades nos dois lados da stack de forma abrangente.

---

### 2. Stack

**Backend:**

Conforme a especificação da vaga, o backend foi desenvolvido em padrão REST 
com Symfony framework, utilizando o Doctrine como ORM, utilizei também algumas bibliotecas
auxiliares, como por exemplo:
- symfony/validator: para fazer a primeira camada de validação dos DTOs
- nelmio/cors-bundle: para auxiliar no controle de CORS do frontend
- symfony/serializer: para encodar as entidades do Doctrine de maneira mais fácil

**Frontend:**

No frontend optei por uma SPA com Vue 3 totalmente desacoplada, pois tenho 
pouca experiência com o Symfony Encore. Utilizei também algumas bibliotecas:
- tailwindcss: para estilização dos componentes
- daisyui: como conjunto de estilos pré-definidos para o Tailwind
- pinia: para controle de estados globais
- pinia-plugin-persistedstate: para facilitar a persistência de estado da aplicação
- chart.js e vue-chartjs: para criação dos gráficos do dashboard
- iconify/vue: para gerenciamento dos ícones

---

### 3. Ambiente de desenvolvimento

*Disclaimer: Geralmente utilizo Docker em ambiente de desenvolvimento, porém não 
consegui gerenciar o tempo para criação dos containers e das imagens.*

*Em compensação subi o projeto na minha VPS de testes, o mesmo pode ser acessado no link abaixo:*

**Link da SPA:** https://onesighttest.tech

#### 3.1 Backend:

Após clonar o projeto:
1. Instalar as dependências: ```composer install```
2. Configurar as variáveis de ambiente:
    - DATABASE_URL: configurar com a DSN do seu banco (ou use Sqlite)
    - CORS_ALLOW_ORIGIN: modificar com a URL local do seu frontend
3. Rodar as migrations: ```bin/console doctrine:migrations:migrate```
4. Iniciar o servidor de desenvolvimento com o Symfony CLI: ```symfony server:start```
5. Por padrão a API vai ser exposta em: ```https://localhost:8000```

#### 3.2 Frontend:

Após clonar o projeto:
1. Instalar as dependências: ```npm install```
2. Configurar as variáveis de ambiente:
    - VITE_APP_DOMAIN: domínio do seu backend
    - VITE_APP_BASE: url completa do seu backend (ex: https://api.onesight.com)
3. Gerar o bundle: ```npm run build```
4. Iniciar o servidor de desenvolvimento: ```npm run preview```