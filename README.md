<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


<p align="center">
<a href="https://icons8.com/icon/20909/html-5"><img src="https://img.icons8.com/color/96/000000/html-5--v1.png" width="60" height="60"/></a>
<a href="https://icons8.com/icon/21278/css3"><img src="https://img.icons8.com/color/96/000000/css3.png" width="60" height="60"/></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.icons8.com/color/96/000000/vue-js.png" width="60" height="60"/></a>
<a href="https://icons8.com/icon/fAMVO_fuoOuC/php-ロゴ"><img src="https://img.icons8.com/officel/80/000000/php-logo.png" width="60" height="60"/></a>
<a href="https://icons8.com/icon/38561/postgreesql"><img src="https://img.icons8.com/color/96/000000/postgreesql.png" width="60" height="60"/></a>
<a target="_blank" rel="noopener noreferrer" href="https://raw.githubusercontent.com/devicons/devicon/master/icons/amazonwebservices/amazonwebservices-original-wordmark.svg"><img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/amazonwebservices/amazonwebservices-original-wordmark.svg" alt="aws" width="60" height="60" style="max-width:100%;"></a>
<a target="_blank" rel="noopener noreferrer" href="https://camo.githubusercontent.com/485ee078eb86b513b5d3f42f7f94a02274d7876667bf1800ccc163ef7e02612e/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f2d2d3334333433342e7376673f6c6f676f3d636972636c656369267374796c653d706c6173746963"><img src="https://camo.githubusercontent.com/485ee078eb86b513b5d3f42f7f94a02274d7876667bf1800ccc163ef7e02612e/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f2d2d3334333433342e7376673f6c6f676f3d636972636c656369267374796c653d706c6173746963" width="70" height="50" data-canonical-src="https://img.shields.io/badge/--343434.svg?logo=circleci&amp;style=plastic" style="max-width:100%;"></a>
    
    
    
## Anibate

Anibateはアニメ好きな人が自分の感想を語り合ったり、視聴作品を記録できたりするプラットフォームです。
豊富なアニメ作品に基づいた感想投稿、簡単な視聴記録をすることができます。

## 使用デモ
![感想投稿](https://user-images.githubusercontent.com/63234480/126925998-5cb4c94d-93db-47a4-acd6-8d8f63088783.gif)
![視聴記録](https://user-images.githubusercontent.com/63234480/126926796-1b3bf5e0-a9c5-4196-b127-2de9c143d6b7.gif)


    
## 使用技術
### バックエンド
- PHP 7.3.28
- Laravel 6.20.27
- [Annict API](https://docs.annict.com/docs/ja/)

### フロントエンド
- HTML
- CSS
- Bootstrap4
- Vue.js 2.6.12
    
### インフラ
 - CircleCI
 - Nginx 1.12.2
 - AWS
    - VPC
    - EC2
      - Amazon Linux2(t2.micro)
    - RDS 
      - PostgreSQL 9.2.24
    - S3(ユーザー画像保存)
    - Route53

![infra](https://user-images.githubusercontent.com/63234480/140248722-a84c8e1a-5e93-4588-a5e2-1c07b034862c.jpg)
### 開発環境
- Laradock

### 機能一覧
- ユーザー登録、ログイン機能(GoogleAPIを使った認証可能)
- ルーム機能
    - ルーム作成
    - リアルタイムチャット
    - ルーム、チャット詳細、編集機能(実装中)
- アニメ検索機能(API使用) *デモ
- アニメ視聴記録(視聴完了時期で検索可能) *デモ
    - マイページにてシーズンごとに検索可能
- 感想投稿機能 *デモ
    - アニメデータに基づいた投稿機能
    - アニメタイトルに基づいた一覧表示
- いいね、コメント機能(Ajax)
- フォロー機能(Ajax)
- [ページネーション機能](https://gist.github.com/simonhamp/549e8821946e2c40a617c85d2cf5af5e)
- ユーザー編集機能
    - 画像設定(S3使用)
