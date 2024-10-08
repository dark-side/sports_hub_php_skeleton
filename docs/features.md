# Features

## Ability to add comment to an article

**Request**

`POST /api/comments`

Body:
```json
{
    "article_id": 1, // unsigned integer value
    "comment": "This is a comment"
}
```

Comments should be validated to have:
- no more than 500 characters
- no HTML code

**Response**

On success
HTTPS status code 201, no body

On failure
HTTPS status code 400 (Bad Request)

Body:
```json
{
    "message": "<failure reason>"
}
```

## Ability to like or dislike an article

**Request**

`POST /api/likes`
```json
{
    "article_id": 1, // unsigned integer value
    "likes": 1 // or "dislikes": 1, unsigned integer value
}
```
Input should be validated.
Increment should be added to respective `likes`` or `dislikes` value in the databasehave.

**Response**

On success
HTTPS status code 200
The updated `likes` and `dislikes` values for the article.

On failure
HTTPS status code 400 (Bad Request)
```json
{
    "message": "<failure reason>"
}
```

## Search in articles

Search is performed and relevant entries returned.

**Request**
`GET /api/articles?text=<search phrase>`
`GET /api/articles?text=<search phrase>&whole=1`

If `<search phrase>` is blank or missing all articles should return.
If no articles found empty array `[]` should return.
Search phrase is split into tokens and checked for any token entry.
If `whole=1` then the whole phrase is searched without splitting.
By default `whole=0`.

**Response**

On success
HTTPS status code 200, array of articles returned

On failure
HTTPS status code 400 (Bad Request)
```json
{
    "message": "<failure reason>"
}
```
