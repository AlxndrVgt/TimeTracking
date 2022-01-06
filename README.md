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

## Task

```json
{
  "id": <int>,
  "customerID": <int>,
  "taskNo": <string>,
  "name": <string>
}
```

### Index

``` GET /api/tasks```

### View

``` GET /api/tasks/<id>```

## TimeEntry

```json
{
    "id": <int>,
    "customerID": <int>,
    "Customer": {
        "id": <int>,
        "customerNo": <int>,
        "name": <string>
    },
    "taskID": <int>,
    "Task": {
        "id": <int>,
        "taskNo": <string>,
        "name": <string>
    },
    "duration": <int>, // in seconds
    "date": <string>, // in format: YYYY-MM-DD
    "description": <string>
}
```

### Index

``` GET /api/timeentries```

### View

``` GET /api/timeentries/<id>```

### Create

``` POST /api/timeentries ```

```json
{
  "customerID": <int>,
  "taskID": <int>,
  "duration": <int>, // in seconds
  "date": <string>, // in format: YYYY-MM-DD
  "description": <string>
}
```

### Update

``` PUT /api/timeentries/<id> ```

```json
{
  "customerID": <int>,
  "taskID": <int>,
  "duration": <int>, // in seconds
  "date": <string>, // in format: YYYY-MM-DD
  "description": <string>
}
```