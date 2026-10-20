# samu-site-pessoal

Cópia pessoal independente do estado de trabalho de `samu-site`, incluindo as
alterações locais existentes em 20/10/2026. O histórico começa nesta cópia:
commits antigos não foram importados porque continham dados e credenciais.

## Executar com XAMPP

1. Use a pasta `samu-site-pessoal` dentro de `htdocs` e inicie Apache e MySQL.
2. Em uma nova clonagem, copie `samu/conexao/conexao.example.php` para
   `samu/conexao/conexao.php` e configure seu banco de desenvolvimento.
3. Copie `samu/maps.local.example.php` para `samu/maps.local.php` e informe suas
   chaves Google Maps. Também são aceitas as variáveis de ambiente
   `GOOGLE_MAPS_API_KEY_1`, `GOOGLE_MAPS_API_KEY_2` e `GOOGLE_MAPS_API_KEY_3`.
4. Prepare um banco de desenvolvimento com a estrutura necessária.
5. Acesse `http://localhost/samu-site-pessoal/samu/`.

A cópia local mantém configurações, uploads e backup apenas no computador;
esses arquivos não são enviados ao Git.

## Banco pessoal isolado

O banco local `basesamu_pessoal` foi criado em 20/10/2026 a partir de `basesamu`,
com 14 tabelas e 24.665 registros. A estrutura e o conteúdo foram conferidos.
O usuário MySQL `samu_pessoal` tem acesso apenas ao banco pessoal; consultas
ao banco original são negadas pelo servidor.

A senha gerada está somente em `samu/conexao/conexao.php`, ignorado pelo Git.
Conexões mysqli, PDO, endpoints de tabelas e exportação usam essa configuração.
Alterações na cópia pessoal não são sincronizadas com o banco original.

Para uma nova instalação, crie um banco e um usuário exclusivos antes de
preencher o arquivo de conexão. O código do repositório não inclui os dados.

## Conteúdo mantido apenas localmente

- Backups SQL, incluindo `basesamu.sql`.
- Configurações com senha de banco e chaves Google Maps.
- Fotos em `samu/upload/` e documentos enviados nas pastas `arquivo/`.
- Configurações do editor e arquivos temporários.

As bibliotecas embarcadas foram preservadas para manter as dependências do
projeto legado. O arquivo de exemplo `samu/maps-teste/map.js` contém um
placeholder no lugar de uma chave real.

## Validação dos fluxos pessoais

Em 20/10/2026, passaram 64 verificações funcionais e 11 verificações de sessão
final. Foram cobertos login válido/inválido, cadastro e edição de usuários,
cadastro/edição/reabertura/listagem nas seis especialidades e nos dois perfis,
acentos e aspas, validação de entradas, logout e acesso sem sessão.

Um cadastro e uma edição também foram realizados pelo navegador e conferidos
no banco pessoal. Os 16 registros temporários foram removidos ao final.
A comparação integral dos registros confirmou o banco original intacto e
os dados preexistentes da cópia pessoal preservados. A sequência automática
de IDs pode conter os intervalos consumidos pelos testes.

As correções incluem o direcionamento correto da edição de usuários,
consultas preparadas nos formulários, preservação de textos com aspas e
interrupção das páginas protegidas quando a sessão não permite acesso.
