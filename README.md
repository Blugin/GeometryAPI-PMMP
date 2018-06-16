<img src="./assets/icon/index.svg" height="256" width="256">  

[![License](https://img.shields.io/github/license/PMMPPlugin/GeometryAPI.svg?label=License)](LICENSE)
[![Release](https://img.shields.io/github/release/PMMPPlugin/GeometryAPI.svg?label=Release)](https://github.com/PMMPPlugin/GeometryAPI/releases/latest)
[![Download](https://img.shields.io/github/downloads/PMMPPlugin/GeometryAPI/total.svg?label=Download)](https://github.com/PMMPPlugin/GeometryAPI/releases/latest)


A plugin skin geometry data api for PocketMine-MP

## Command
Main command : `/geometry <list | lang | reload | save>`

| subcommand | arguments              | description                 |
| ---------- | ---------------------- | --------------------------- |
| List       | \[page\]               | Show geometry list          |
| Lang       | \<language prefix\>    | Load default lang file      |
| Reload     |                        | Reload all data             |
| Save       |                        | Save all data               |




## Permission
| permission          | default  | description        |
| ------------------- | -------- | ------------------ |
| geometry.cmd        | OP       | main command       |
|                     |          |                    |
| geometry.cmd.list   | OP       | list subcommand    |
| geometry.cmd.lang   | OP       | lang subcommand    |
| geometry.cmd.reload | OP       | reload subcommand  |
| geometry.cmd.save   | OP       | save subcommand    |
