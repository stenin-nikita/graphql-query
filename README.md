# GraphQL Query Parser

### Example

```php
$parser = new \Stenin\GraphQLQuery\QueryParser();

$ast = $parser->parse('
query {
    users(count: 15) {
        id
        login
    }
}
');
```