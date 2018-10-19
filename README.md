# phalcon-oauth2
phalcon 多模块实现的oauth2

## Composer 安装

```composer
composer install
```

## Usage

### 请求Token信息:
授权模式：Password Grant Flow
```http request
POST /oauth2/auth/token

请求参数：
client_id : test
client_secret : secret
grant_type : password
username : abc
password : abc
```

返回结果：
```json
{
    "status": "success",
    "data": {
        "token_type": "Bearer",
        "expires_in": 2678399,
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjY5Y2EzMjkxMmE3OGM5NjkzYjNkNWI5M2QyZjIxZWNlN2I1YmVhMTEzN2Y5MDFjNDAyMjU2YjQ4ZjE4YmM0NTRmNjg3ZjM1ODRjNDM2MjgxIn0.eyJhdWQiOiJ0ZXN0IiwianRpIjoiNjljYTMyOTEyYTc4Yzk2OTNiM2Q1YjkzZDJmMjFlY2U3YjViZWExMTM3ZjkwMWM0MDIyNTZiNDhmMThiYzQ1NGY2ODdmMzU4NGM0MzYyODEiLCJpYXQiOjE1Mzk5MzIzNzAsIm5iZiI6MTUzOTkzMjM3MCwiZXhwIjoxNTQyNjEwNzY5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.ECztgqH7pDw5AJWo0UjH8fb72rGCSeJWVnZJqMQKrQugNXL1EBZSWml1ojPPct5vkdZ-0rLzNspxj-VLPCgiaXt-jOQH8HvsBmY_fSsK9EurQBNnHugIbht7EGQ_QcmzK71fr9kypouP4bhiLRxB6ceEa4IBqxMAjayAHjVyCjRjAWzVByTf4nGeplOwVHChPCY3afrNnPKeupLO8uygd5mefBzcKaF0KcLkevtVXc9EROguQgZDUceAvl_ka1YCiXNxLfI05ijeeKwAdI5HCyI3JldJDbn3CUgvr84vlOTRp3nL_J24emhvaUFioPlqXU-_rGXcnxAc_sipApiuGg",
        "refresh_token": "def50200e3934e5741f2c6d80f9515d0e3fbdcce30a7d8776d5c82f7a10d79462c6d0edaa74c1eb3c39687a444d3984d0e24b0dffd45e94a3648d57e5270d182294a9b895d52662ec3214cdab19954dc501ff866a76a2ff65898c07d4e4aaf63ef2d0b0eb26252239edb3e3388dd06e6409e7bc1d8be6c862b10a346683061badc02dd50e3b1715eccfd2e31ada2faaa77e2c805ae3eed406ec712639082cdd82bef5200ccee69324fda3ea90491bca0e41fa16cb00c9f9b22349c18cbd256fdef0724a97b4b22036a331ab47da84fa9afdd916d0c8e3fb15f3e21665a057baa0c2411be4863f6f255fc0832e2ad96d8b0bd6da07c44c6fb6b7a692e7817b2dafa78f33587115f02509a4dd1916adbc4e21325752247fcfd1696e3cc661c4e7525a90fb1adb21055870db891bf33bed3e730affb2d571a5f6d673af6364c51175d84aebe9564d114603d0a7b5d32c3474060964d5755d2ff7719ad2bd1fd80f4fad906c9eca9"
    }
}
```

### 验证Token信息:
```http request
POST /oauth2/auth/validate

请求header中加入：
Authorization : Bearer {{access_token}}
```

返回结果：
```json
{
    "status": "success",
    "data": [
        {
            "oauth_access_token_id": "e4ae7e8c83d2d8183ed0b3415f735c230a7512aae0df6297f0c46a0b986f046faa0ac34c36b9a8d9",
            "oauth_client_id": "test",
            "oauth_user_id": "1",
            "oauth_scopes": [
                {
                    "id": "1",
                    "scope": "Student",
                    "is_default": "1",
                    "created_at": "2018-10-18 08:51:34",
                    "updated_at": "2018-10-18 08:51:39"
                }
            ]
        }
    ]
}
```
