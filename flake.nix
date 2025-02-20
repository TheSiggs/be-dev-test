{
  description = "PHP Laravel development environment";

  inputs = {
    nixpkgs.url = "github:NixOS/nixpkgs/nixos-unstable";
    flake-utils.url = "github:numtide/flake-utils";
  };

  outputs = { self, nixpkgs, flake-utils }:
    flake-utils.lib.eachDefaultSystem (system:
      let
        pkgs = import nixpkgs { inherit system; };

        php = pkgs.php83.withExtensions (exts: with pkgs.phpExtensions; [
          curl
          dom
          fileinfo
          mbstring
          iconv
          openssl
          pdo
          pdo_mysql
          pdo_sqlite
          pdo_pgsql
          xmlwriter
          redis
          tokenizer
          zip
          filter
        ]);

      in
      {
        devShells.default = pkgs.mkShell {
          name = "Laravel Dev Shell";
          buildInputs = [
            php
            pkgs.phpExtensions.mbstring # Explicitly include mbstring
            pkgs.phpExtensions.iconv # Explicitly include iconv
            pkgs.phpPackages.composer
            pkgs.phpExtensions.xdebug
            pkgs.phpExtensions.xml
            pkgs.phpExtensions.xmlwriter
            pkgs.nodejs_20
            pkgs.yarn
            pkgs.mariadb
            pkgs.redis
            pkgs.nginx
            pkgs.sqlite
          ];

          shellHook = ''
            export PATH="$HOME/.composer/vendor/bin:$PATH"
            export COMPOSER_HOME="$HOME/.composer"
          '';
        };
      }
    );
}

