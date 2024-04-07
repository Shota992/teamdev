FROM nginx:latest
# タイムゾーン(東京)
ENV TZ Asia/Tokyo

# nginxのconfigファイル(default.conf)をコピー
COPY ./docker/nginx/*.conf /etc/nginx/conf.d/
# このコンテナに入った時のカレントディレクトリ
WORKDIR /var/www/html

server {
    listen 80;

    # サーバー名とルートディレクトリを設定するなど、サーバーの設定を行います

    location / {
        # PHP-FPM サーバーへのリクエストを処理する
        proxy_pass http://php:8080;
        # その他の必要な設定を行うことができます
    }
}
