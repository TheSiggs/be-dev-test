include .env
export $(shell sed 's/=.*//' .env)

help: # Lists commands
	@awk 'BEGIN { print "Available commands:"; } \
		 /^##/ { printf "\n\033[1m%s\033[0m\n", substr($$0, 3); next; } \
		 /^[a-zA-Z0-9_-]+:/ { \
			 split($$0, parts, /:.*#/); \
			 cmd = parts[1]; \
			 sub(/^[ \t]+/, "", cmd); \
			 desc = substr($$0, index($$0, "#") + 1); \
			 if (desc != "") \
				 printf "\033[36m%-30s\033[0m %s\n", cmd, desc; \
		 }' $(MAKEFILE_LIST)


start: up migrate # Sets up the project and starts all the containers

up: # Starts the containers
    # Setting up containers individually to allow chaining of make up migrate to not fail due to the db container not running in time
	docker compose up db -d
	docker compose up app -d

down: # Downs the containers
	docker compose down -t1

migrate: # Runs the migrations
	docker compose exec app php artisan migrate --force
