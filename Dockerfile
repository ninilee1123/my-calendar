# PHP 포함된 기본 이미지
FROM php:8.2-cli

# 필요한 모듈 설치 (옵션)
RUN docker-php-ext-install mysqli

# 앱 코드 복사
WORKDIR /app
COPY . .

# 포트 열기
EXPOSE 10000

# 서버 실행
CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
