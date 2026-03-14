# 🛒 Roadmap do Projeto: E-commerce Supermercado MVC

Este documento serve como um mapa (Roadmap) para guiá-lo no desenvolvimento do seu supermercado online utilizando a sua arquitetura MVC customizada em PHP. Marque os checkboxes (`[x]`) conforme avança.

---

## 🏗️ Fase 1: Arquitetura Inicial e Bancos de Dados
**Foco:** Planejamento estrutural das tabelas, chaves estrangeiras, relacionamentos e Models no código. *(Concluído 🎉)*
- [x] Extensão do `Blueprint` para contemplar Datas e Soft Deletes.
- [x] Criação da estrutura de **Usuários e Endereços** (Cpf, roles, etc).
- [x] Criação da estrutura de **Categorias, Produtos e Promoções** (Folheto de descontos datados).
- [x] Criação da estrutura de **Carrinho, Pedidos e Itens** (com congelamento de preços históricos e fluxo para entregadores).
- [x] Mapeamento dos relacionamentos (`belongsTo`, `hasMany`) nos *Models*.
- [x] Migração dos bancos executada com sucesso.

---

## 🔐 Fase 2: Autenticação e Perfis (Access Control)
**Foco:** Garantir que tenhamos quem use o sistema (Clientes e Administradores) de forma segura.
- [x] Implementar as telas e lógicas de Login e Cadastro de Usuário (`AuthController`).
- [x] Criar/Ajustar um **Middleware** capaz de verificar se o usuário logado possui a *role* `admin` ou `cliente` para bloquear acessos não autorizados.
- [x] Painel do Usuário Logado ("Minha Conta").
- [x] CRUD (Criar, Editar, Listar e Excluir) da tabela `enderecos` dentro do painel do cliente, suportando múltiplos endereços.

---

## 🛠️ Fase 3: Painel Administrativo (Gestão do Supermercado)
**Foco:** CRUDs (Telas restritas aos gerentes e funcionários) para retroalimentar o sistema.
- [x] **Gestão de Categorias:** Listagem, inserção e exclusão (soft delete) das categorias de prateleira (Frios, Açougue, Mercearia).
- [x] **Gestão de Produtos:** Upload de Imagens no servidor, definição de preços e estoque, e vinculação com uma Categoria já cadastrada.
- [x] **Promoções (O "Folheto"):** Tela para escolher produtos existentes e aplicar a eles um `preco_promocional` agendando a `data_inicio` e a `data_fim`, além de definir a flag de `destaque_folheto`.
- [x] **Acessos:** Tela para o Admin incluir, editar e bloquear acessos de `funcionarios` que gerenciarão a loja.

---

## 🛍️ Fase 4: Frente de Loja (Vitrine Pública)
**Foco:** Navegação do usuário interessado nos produtos. Interface rápida e atraente.
- [x] **Home Page (Folheto):** `HomeController` renderizando a view inicial. A interface deve consultar no BD todas as `promocoes` cuja `data_inicio` <= hoje e `data_fim` >= hoje com *destaque folheto = 1*.
- [x] **Listagem por Categoria:** Criar um menu ou filtro para o cliente listar "Apenas Frios", "Apenas Hortifruti", etc., exibindo os produtos do respectivo `categoria_id`.
- [x] **Busca:** Campo de busca textual por nome do produto usando simples *like* no backend e SQL paramétrico (segurança contra SQL Injection).

---

## 🛒 Fase 5: Operação de Compra (Carrinho e Checkout)
**Foco:** Fazer o cliente adicionar produtos para poder pagar. Lógica pura!
- [ ] **Controlador de Carrinho:** Rotas de *Ação* (add_item, upd_item, rm_item). 
- [ ] **Sessões e BD:** Vincular o Carrinho a tabela `carrinhos` juntamente com `carrinho_itens` apontando para o id do `Usuario`.
- [ ] **Revisão:** Telinha para revisão final exibindo endereço selecionado + o combo de "Método de Pagamento da Entrega" (ex: Dinheiro ou Maquininha), pedindo a informação de "Qual o seu troco?".
- [ ] **Finalizar Compra:** Pegar os itens do Carrinho -> Inseri-los como `pedidos` (congelar o valor original individual dos produtos em seu registro) ->  Limpar os `carrinho_itens`.

---

## 🚚 Fase 6: Logística e Monitoramento dos Encomendas
**Foco:** Fluxos diários de andamento para o cliente e gestor.
- [ ] **Acompanhamento no Front (Cliente):** O usuário deve acessar a guia "Meus Pedidos" e ver em qual *status* o pedido recém efetuado dele está, junto aos itens.
- [ ] **Quadro Operacional Diário (Admin):** Uma tela estilo "Kanban" no Admin para enxergar pedidos `pendentes`.  
- [ ] O funcionário aprova, mandando o status para `separacao` ou cancelando. 
- [ ] Quando despachar, muda para `saiu_entrega` (sinalizando a maquininha ou o exato troco anotado pro motoboy)
- [ ] Registrar na coluna de log/auditoria do banco (ex: `notificado_em`) avisando o cliente via E-mail (módulo *SMTP/PHPMailer*) a mudança de cada status.

---

## 🎨 Fase 7: Ajustes Finos (Opcional & UI/UX)
- [ ] Layout Mobile First (clientes compram de supermercado via celular); caprichar em *views* ágeis. CSS/Bootstrap/TailwindCSS a ser aplicado.
- [ ] Refatorar lógicas repetitivas do Controller de para Serviços Independentes (`app/Services`).
- [ ] Elaborar Dashboards com Gráficos para o Gestor ("Produtos mais vendidos", "Faturamento do Hoje").
