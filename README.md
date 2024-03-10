# Project-Manager-Easyadmin

This is a simple project manager.

Stack: Symfony 7.0, EasyAdmin 4, TailwindCSS 3.4

## Installation

### 1. Get sources
```bash
git clone git@github.com:CharlesLLM/Project-Manager-Easyadmin.git
```

### 2. Environment variables
Create a `.env.local` file to override the values in the .env file.

### 3. Start the project
```bash
make start
```

### 4. Go to [http://localhost:8000](http://localhost:8000)

## Usage

*Make Commands* :

| Command     | Usage                            |
| ----------- | -------------------------------- |
| make start  | Start the project                |
| make up     | Start the server                 |
| make stop   | Stop the server                  |
| make db     | Init database with data fixtures |
| make cc     | Clear cache                      |
| make assets | Regenerate assets files          |
| make vendor | Install dependencies             |

## List of users for testing

| Email                | Password    | Roles      |
| -------------------- | ----------- | ---------- |
| `user1@test.fr`      | `Admin123!` | ROLE_ADMIN |
| `user{2..5}@test.fr` | `User123!`  | ROLE_USER  |

These users are created with the fixtures. You can find all the fixtures in the `src/DataFixtures` folder.

## File management

The files are stored in the `public/uploads` directory.
