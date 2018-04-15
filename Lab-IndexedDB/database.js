///------------------------------------------
//  Este arquivo representa uma abstração do banco de dados para uma aplicação de exemplo
//  OBS: parte do código e ideias da estrutura foram extraídos dos sites 
//       https://www.w3.org/TR/IndexedDB
//       https://developer.mozilla.org/pt-BR/docs/IndexedDB/Usando_IndexedDB
//
//  Autor: Rommel Vieira Carneiro
///------------------------------------------

// variáveis que armazenam a conexão ao banco de dados
var db_app;
// Constantes para nomes do banco de dados e ObjectStores
const CONST_DB_APP = "pucminas.br.db_app";
const CONST_OS_CONTATO = "os_contato";

function initDBEngine() {
    // Na linha abaixo, você deve incluir os prefixos do navegador que você vai testar.
    window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB;
    // Não use "let indexedDB = ..." se você não está numa function.
    // Posteriormente, você pode precisar de referências de algum objeto window.IDB*:
    window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction || window.msIDBTransaction;
    window.IDBKeyRange = window.IDBKeyRange || window.webkitIDBKeyRange || window.msIDBKeyRange;
    // (Mozilla nunca usou prefixo nesses objetos, então não precisamos window.mozIDB*)

    if (!window.indexedDB) {
        window.alert("Seu navegador não suporta uma versão estável do IndexedDB. Alguns recursos não estarão disponíveis.");
    }
}

function getObjectStore(store_name, mode) {
    let tx = db_app.transaction(store_name, mode);
    return tx.objectStore(store_name);
}

function displayMessage(msg) {
    $('#msg').html('<div class="alert alert-warning">' + msg + '</div>');
}

function openDB() {
    request = indexedDB.open(CONST_DB_APP);

    request.onerror = function (event) {
        alert("Você não habilitou minha web app para usar IndexedDB?!");
    };
    request.onsuccess = function (event) {
        db_app = request.result;
    };
    request.onupgradeneeded = function (event) {
        let store = event.currentTarget.result.createObjectStore(
            CONST_OS_CONTATO, { keyPath: 'id', autoIncrement: true });

        store.createIndex('nome', 'nome', { unique: true });
        store.createIndex('telefone', 'telefone', { unique: false });
        store.createIndex('email', 'email', { unique: true });

        // Carrega dados ficticios
        loadDadosContatos(store);
    };
}

function insertContato(contato) {
    let store = getObjectStore(CONST_OS_CONTATO, 'readwrite');
    let req;
    req = store.add(contato);

    req.onsuccess = function (evt) {
        displayMessage("Contato inserido com sucesso");
    };

    req.onerror = function () {
        displayMessage("Erro ao adicionar contato", this.error);
    };
}

function getAllContatos(callback) {
    let store = getObjectStore(CONST_OS_CONTATO, 'readonly');
    let req = store.openCursor();
    req.onsuccess = function (event) {
        let cursor = event.target.result;

        if (cursor) {
            req = store.get(cursor.key);
            req.onsuccess = function (event) {
                let value = event.target.result;
                callback(value);
            }
            cursor.continue();
        }
    };
    req.onerror = function (event) {
        displayMessage("Erro ao obter contatos:", event.target.errorCode);
    };
}

function getContato(id, callback) {
    let store = getObjectStore(CONST_OS_CONTATO, 'readwrite');
    if (typeof id == "string") { id = parseInt(id); }
    let req = store.get(id);
    req.onsuccess = function (event) {
        let record = req.result;
        callback (record);
    };
    req.onerror = function (event) {
        displayMessage("Contato não encontrado:", event.target.errorCode);
    };
}

function deleteContato(id) {
    let store = getObjectStore(CONST_OS_CONTATO, 'readwrite');
    if (typeof id == "string") { id = parseInt(id); }
    let req = store.delete(id);
    req.onsuccess = function (event) {
        displayMessage("Contato removido com sucesso");
    };
    req.onerror = function (event) {
        displayMessage("Contato não encontrado ou erro ao remover:", event.target.errorCode);
    };
}

function updateContato(id, contato) {
    let store = getObjectStore(CONST_OS_CONTATO, 'readwrite');
    if (typeof id == "string") { id = parseInt(id); }
    let req = store.get(id);
    req.onsuccess = function (event) {
        let record = req.result;
        record.nome = (contato.nome != "") ? contato.nome : record.nome;
        record.telefone = (contato.telefone != "") ? contato.telefone : record.telefone;
        record.email = (contato.email != "") ? contato.email : record.email;

        let reqUpdate = store.put(record);
        reqUpdate.onsuccess = function () {
            displayMessage("Contato alterado com sucesso");
        }
        reqUpdate.onerror = function (event) {
            displayMessage("Erro ao alterar contato:", event.target.errorCode);
        };
    };
    req.onerror = function (event) {
        displayMessage("Contato não encontrado ou erro ao alterar:", event.target.errorCode);
    };
}

function loadDadosContatos(store) {
    // Isso é o que os dados de nossos clientes será.
    const dadosContatos = [
        { nome: "Rafael Souza", telefone: "31-99856-3358", email: "rafaels11@hotmail.com" },
        { nome: "Tereza Cristina", telefone: "31-99667-4457", email: "terezac2017@gmail.com" },
        { nome: "Antônio Teixeira", telefone: "31-99614-4885", email: "antonioteixeira@gmail.com" },
        { nome: "Catarina Alves", telefone: "31-98863-4452", email: "catarina.alves@globo.com" },
        { nome: "Manuela Silva", telefone: "31-98477-4367", email: "manusilva@gmail.com" },
        { nome: "Afonso Cardoso", telefone: "31-98554-4547", email: "acbh1987@gmail.com" }
    ];

    let req;
    dadosContatos.forEach((element, index) => { req = store.add(element) });
    req.onsuccess = function (evt) { };
    req.onerror = function () { };
}

