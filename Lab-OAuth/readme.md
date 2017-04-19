# Introdução 
O OAuth é um protocolo que permite integrar a autenticação e a autorização de recursos em sites da Web de maneira muito interessante. Com ele, é possível oeferecer a usuários de aplicações Web o acesso a fotos do Google, listas de amigos do Facebook e muito mais.

**```IMPORTANTE```** 
Os valores de Aplication Secret Key disponibilizados no código **NÃO SÃO VÁLIDOS** pois foram alterados. Para testar será necessário que você crie uma aplicação na sua conta junto ao Google e ao Facebook e altere os códigos para refletir isso. Para fazer isto, acesse:
- [Facebook for Developers](https://developers.facebook.com/apps/)
- [Google Developers Console](https://console.developers.google.com/apis/credentials)

## Papéis

Para isto, é preciso conhecer um pouco sobre o O Auth. Ele define, nas aplicações que vão utilizá-lo, 4 papéis básicos:
- **Dono do Recurso (Resource Owner)**: Entidade capaz de conceder acesso a um recurso protegido. *Ex: Usuário final*
- **Aplicação Cliente (Client)**: Sistema que acesso recursos em nome do dono. *Ex: Aplicativo qualquer no celular*
- **Servidor de Recursos (Resource Server)**: Ambiente que hospeda recursos protegidos do dono. *Ex: Google Fotos*  
- **Servidor de Autorização (Authorization Server)**: Servidor que gera tokens de acesso à aplicação cliente. *Ex: Google Account*

**```Exemplo ilustrativo```**: Imagine acessar um site epecífico para imprimir fotos que foram compartilhadas por meio do Google Fotos. Para isso, o site específico terá que obter a permissão do usuário por meio do servidor de autorização do Google Fotos, que no caso é o Google Accounts. Neste caso temos o usuário final como ```Dono do Recurso```, o Site específico como ```Aplicação Cliente```, o Google Accounts como ```Servidor de Autorização``` e o Google Fotos como ```Servidor de Recursos```.

## Fluxos
O mecanismo do OAuth pode ser utilizado de 4 maneiras de autorização ou fluxos, como é descrito na [RFC 6749](https://tools.ietf.org/pdf/rfc6749.pdf):
- **Autorization Code**: ocorre quando ```Dono do Recurso``` ou um usuário final acessa uma ```Aplicação Cliente``` para acessar informações em um ```Servidor de Recursos```. Para isto, a ```Aplicação Cliente``` utiliza um ```Servidor de Autorização``` para que o usuário final autorize o acesso às informações por parte da ```Aplicação Cliente```. Neste fluxo, é necessário registrar a ```Aplicação Cliente``` junto ao ```Servidor de Autorização```.
- **Implicit**: Muito parecido com o fluxo de Authorization Code, porém ocorre quando a ```Aplicação Cliente``` é baseada em um código em linguagem script no próprio browser sem interação com um servidor. Não requer o registro da ```Aplicação Cliente```.
- **Resource Owned Password Credentials**: Este fluxo é utilizado normalmente quando a ```Aplicação Cliente``` também faz parte da infraestrutura composta que ```Servidor de Autorização``` e o ```Servidor de Recursos```. Imagine uma aplicação do Facebook tentando acessar recursos compartilhados por você no próprio Facebook. Neste caso, lhe serão pedidos login e senha para acessar o ambiente.
- **Client Credentials**: Acontece quando a ```Aplicação Cliente``` atua como um ```Dono do Recurso``` e, portanto, a credencial é previamente acertada com o ```Servidor de Autorização``` e a ```Aplicação Cliente``` não requer qualquer informação ou ação do usuário final para acessar os recursos que serão oferecidos. 


 
