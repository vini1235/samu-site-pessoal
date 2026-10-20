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

A cópia local inicial mantém as configurações, uploads e backup existentes,
mas esses arquivos não são enviados ao Git. O banco MySQL não foi duplicado:
a conexão local continua apontando para o banco original, até ser reconfigurada.

## Conteúdo mantido apenas localmente

- Backups SQL, incluindo `basesamu.sql`.
- Configurações com senha de banco e chaves Google Maps.
- Fotos em `samu/upload/` e documentos enviados nas pastas `arquivo/`.
- Configurações do editor e arquivos temporários.

As bibliotecas embarcadas foram preservadas para manter as dependências do
projeto legado. O arquivo de exemplo `samu/maps-teste/map.js` contém um
placeholder no lugar de uma chave real.
