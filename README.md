# Project-Manager-Easyadmin

This is a simple project manager.

Stack: Symfony 7.0, EasyAdmin 4, TailwindCSS 3.4

## Installation

```bash
git clone git@github.com:CharlesLLM/Project-Manager-Easyadmin.git
cd Project-Manager-Easyadmin
make start
```
And then go to [http://localhost:8000](http://localhost:8000)

## Usage

Start the server: `make up`  
Stop the server: `make stop`  
Reload fixtures: `make fixtures`  
Clear cache: `make cc`  
Load assets: `make assets`

## List of users for testing

| Email                       | Password | Roles                                    |
| --------------------------- | -------- | ---------------------------------------- |
| `user1@test.fr`             | `admin`  | ROLE_ADMIN                               |
| `user{2..5}@test.fr`        | `user`   | ROLE_USER                                |

These users are created with the fixtures. You can find all the fixtures in the `src/DataFixtures` folder.

## File management

The files are stored in the `public/uploads` directory.
