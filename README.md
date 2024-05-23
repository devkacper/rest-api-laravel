# REST API Endpoints


Find pet by Id:

```bash
GET: /api/pet/{petId} 
```

Add a new pet to the store:

```bash
POST: /api/pet
```

Update an existing pet:

```bash
PUT: /api/pet/{petId}
```

Delete a Pet:

```bash
DELETE: /api/pet/{petId}
```

Finds Pets by status:

- available
- sold
- pending

```bash
GET: /api/pet/findByStatus
```

Uploads an image (mimes - png, jpg, jpeg, max file size: 2 MB):

```bash
POST: /api/pet/{id}/uploadImage
```


