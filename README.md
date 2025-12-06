# About this Refactoring Task

This repository contains a refactoring exercise based on an existing codebase.  
The original source was functional, but included several candidates for improvement.  
I focused on restructuring the code to be cleaner, more modular, and easier to maintain.

## Goals & Principles

During the refactor, I was guided by the following principles:

- ✅ Keep the application in a **running state**
- ✨ Perform **code cleanups** (variable naming, modular structure, clarity)
- 🧪 Ensure **100% testability** and maintain code coverage
- 🔗 Remain **framework‑agnostic** so classes can be reused in any environment
- 📐 Follow **SOLID** principles and **KISS** (Keep It Simple, Stupid)

## Process

- The initial submission (first push) represented ~3 hours of focused work.
- After code review, I continued refining the code based on feedback and my own observations.
- The result is a cleaner, more maintainable version of the original task.

## Symfony Version

Alongside this refactor, I created a **Symfony‑based version** (first version).  
This variant currently includes only the changes from the initial push of the refactor, reused within a Symfony setup to demonstrate how the classes can be integrated into a modern framework.  
The repository will be updated and synced with the latest improvements from the refactor so that the Symfony version reflects the most recent changes as well (soon).

## Handlers

- `\App\Handler\PermissionHandler` — represents the **original source code** provided for the task.
- `\App\Handler\PermissionHandlerV2` — the **refactored endpoint**, showcasing the improved design and structure.

## About

There are many possible ways to approach a refactoring task like this.  
This repository reflects the path I chose, based on the time available and the aspects I decided to prioritize.  
Different contexts — such as deadlines, scope, or focus areas — can naturally lead to different solutions.  
The aim here is not to present a “perfect” approach, but to share one practical example of applying clean code principles and framework‑agnostic design.

## Original Notes

The sections that follow are taken directly from the original README/content provided with the task. 

---

# ACME Refactoring Task
This project only includes the route `GET /has_permission/{token}` which has to decide if the provided token exists and has the required permission.
Your task is to refactor the endpoint and create tests, if necessary.

# Requirements
- php 8.1
- composer

# Installation
```shell
$ composer install
```

# Run
```shell 
$ php src/main.php
```
Expected output: 
```shell
[INFO] Registering GET /has_permission/{token}
[INFO] Server running on 127.0.0.1:1337
```

# Testing
```shell
$ php vendor/bin/phpunit Test
```
