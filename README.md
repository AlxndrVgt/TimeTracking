Backend and API for TimeTracking App.

# API

## Customer

```json
{
  "id": <int>,
  "customerNo": <int>,
  "name": <string>
}
```

### Index

``` GET /api/customers```

``` GET /api/customers?customer=<id> ```

### View

``` GET /api/customers/<id>```

