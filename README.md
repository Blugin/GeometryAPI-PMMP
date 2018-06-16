<img src="./assets/icon/index.svg" height="256" width="256">  

[![License](https://img.shields.io/github/license/PresentKim/GeometryAPI-PMMP.svg?label=License)](LICENSE)
[![Release](https://img.shields.io/github/release/PresentKim/GeometryAPI-PMMP.svg?label=Release)](https://github.com/PresentKim/GeometryAPI-PMMP/releases/latest)
[![Download](https://img.shields.io/github/downloads/PresentKim/GeometryAPI-PMMP/total.svg?label=Download)](https://github.com/PresentKim/GeometryAPI-PMMP/releases/latest)


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
