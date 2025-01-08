## いったんコピペなのです（2025/01/08）


'''
# LP2020
no need to use docker.

## Installation
- Get project form this repository on GitHub
```
git clone https://-----------------
```

- Prepare for laravel
```
cd src

composer install

cp .env.example .env

php artisan key:generate
```

- Prepare for DB
  - create Database
  - edit .env(dbname, PW etc) to use Database 

- create table
```
php artisan migrate --seed
```

- start built in server
```
php artisan serve
```
## Gitflow
### ・ブランチの切り方
* 必ず<strong>masterブランチ</strong>から<strong>作業用ブランチ</strong>を切る<br>

### ・作業用ブランチ名の付け方
<strong>type-issue番号-担当者</strong>

1. <strong>先頭にtypeを書く（コミットメッセージのところでtypeを定義している）</strong>
    * 例）LPのバグ修正 → fix-〇〇-〇〇
    * 例）LPの機能追加、変更 → feat-〇〇-〇〇

2. <strong>issueの番号書く</strong>
    * 例）250番のissueに対するブランチを作成する → fix-250-〇〇


3. <strong>担当者名書く</strong>
    * 例）DaikiMakiが担当 → fix-250-DaikiMaki

## コミット
### ・コミットメッセージの書き方
<strong>[type] # issue番号 行った内容</strong>

例）
[feat] #250 STSLPからのお問い合わせ内容がSlackに反映されなかったので、Controllerを修正

↓typeは下記として定義する↓

```
* docs
    * READMEなどのドキュメントの更新

* feat
    * ユーザー向けの機能の追加や変更

* fix
    * ユーザー向けの不具合の修正

* refactor
    * リファクタリングを目的とした修正

* style
    * 空白、フォーマット、セミコロン追加など

* perf
    * パフォーマンス向上
``` 

## その他
PRの説明文に下記を書くことで、PRとissueが紐づき、PRがマージされた時にissueも自動でクローズされる

```
Close #issue番号
```

XAMPPでPHPをインストールした場合、バージョン8.0以降のためLaravel7系と合わない可能性あり
対処法
```
HomebrewからPHPをインストールしてバージョンダウングレードを行う
```


''''
