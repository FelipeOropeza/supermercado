# 🛒 Supermercado MVC — High-Performance E-commerce

![Status](https://img.shields.io/badge/Status-Project_Finalized-green?style=for-the-badge)
![Tech](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Infrastructure](https://img.shields.io/badge/FrankenPHP-Worker_Mode-00ADD8?style=for-the-badge&logo=caddy&logoColor=white)
![Engine](https://img.shields.io/badge/HTMX-Enabled-3D72D7?style=for-the-badge)

Um ecossistema completo de supermercado online, construído sobre um **Micro-Framework MVC customizado** em PHP puro. O projeto foi desenhado sob a premissa de **Performance Extrema (Worker Mode)**, utilizando as tecnologias mais modernas de 2024/2025 para entregar uma experiência de Single Page Application (SPA) sem a complexidade de frameworks pesados de JS.

---

## ⚡ Diferenciais de Engenharia

Este não é apenas um CRUD. É um estudo de caso em arquitetura moderna de software:

*   **⚡ FrankenPHP Worker Mode**: A aplicação opera em modo persistente na memória, eliminando o overhead de boot do PHP em cada requisição. Respostas na casa dos **micro-segundos**.
*   **📡 Comunicação em Tempo Real (Mercure)**: Integração nativa com o hub Mercure para notificações de estoque, atualizações de preços e alterações de status de pedidos via Server-Sent Events (SSE).
*   **🧩 SPA-like UX via HTMX**: Navegação fluida e reativa através de interações parciais no DOM, minimizando o tráfego de rede e garantindo uma experiência premium.
*   **🏗️ IoC & Autowiring**: Container de Injeção de Dependências robusto com suporte a Service Providers (estilo Laravel), facilitando a testabilidade e o desacoplamento.
*   **🛡️ Segurança Industrial**: Proteção nativa contra CSRF, SQL Injection (PDO), XSS e uma camada de RBAC (Role-Based Access Control) granular para Admin, Gerentes e Clientes.

---

## 🚀 Principais Funcionalidades

### 🛒 Frente de Loja (Público)
*   **Vitrine Inteligente**: Promoções dinâmicas baseadas em datas de início/fim (Folheto Digital).
*   **Busca Semântica**: Filtros rápidos por categoria e busca textual otimizada.
*   **Carrinho Persistente**: Gerenciamento híbrido (Sessão + BD) para garantir que o cliente nunca perca seus itens.
*   **Checkout Simplificado**: Fluxo de multi-endereços e definições de pagamento na entrega (Troco, Cartão, Dinheiro).

### 🛠️ Painel Administrativo (Gestão)
*   **Dashboard Executivo**: KPIs em tempo real, alertas de baixo estoque e totalizadores de faturamento.
*   **Gestão de Inventário**: CRUD completo de produtos e categorias com suporte a **Soft Deletes**.
*   **CRM & Acessos**: Controle total sobre usuários e hierarquia de permissões de funcionários.
*   **Operação Logística**: Quadro **Kanban** para separação e despacho de pedidos, com atualização automática de estoque na entrega final.

---

## 🛠️ Stack Tecnológica

| Camada | Tecnologia |
| :--- | :--- |
| **Backend** | PHP 8.2+ (MVC Puro) |
| **Servidor/Runtime** | FrankenPHP (Caddy), Docker Compose |
| **Frontend** | Tailwind CSS 4, HTMX, JavaScript (ES6), Alpine.js |
| **Real-time** | Mercure Hub (SSE) |
| **Banco de Dados** | MySQL (PDO) com Query Builder Independente |

---

## 📦 Como Rodar (Quick Start)

### 🐋 Via Docker (Obrigatório para Worker Mode)
A experiência completa de performance só é alcançada utilizando o ambiente Docker configurado:

1. Clone o repositório:
   ```bash
   git clone https://github.com/FelipeOropeza/supermercado.git
   cd supermercado
   ```

2. Suba o ambiente:
   ```bash
   docker-compose up -d --build
   ```

3. Acesse `http://localhost:8000`. O hub Mercure estará operando em `http://localhost:3000`.

---

## 🛠️ Ferramenta de Linha de Comando (Forge)
O sistema acompanha o **Forge**, uma CLI poderosa para acelerar o desenvolvimento:

```bash
# Executar migrações
php forge migrate

# Criar novos componentes
php forge make:controller NomeController
php forge make:model NomeModel
php forge make:migration CreateTableX
```

---

## 📄 Licença

Este projeto está sob a licença **MIT**. Desenvolvido com ❤️ por [Felipe Oropeza](https://github.com/FelipeOropeza).
