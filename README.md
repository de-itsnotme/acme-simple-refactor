# About this Refactoring Task

This repository is both a refactoring exercise and a demonstration of my coding style and approach to software design.  
The original source was functional, but included several opportunities for improvement. I focused on restructuring the code to be cleaner, more modular, and easier to maintain.

> **Note on commits and anonymization**  
> The original commits contained traces of organizational details and references to the people who built this refactoring test.  
> To respect privacy, I have anonymized the repository to the best of my ability.  
> As part of this process, the original commit history has been removed.  
> The distinction between old and new code is now represented clearly by:
> - `\App\Handler\PermissionHandler` (original)
> - `\App\Handler\PermissionHandlerV2` (refactored)

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
- The result is a cleaner, more maintainable version of the original task, and I keep adding improvements whenever I find new ideas worth exploring.

## Symfony Version

Alongside this refactor, I created a **Symfony‑based version** (first version).  
This variant currently includes only the changes from the initial push of the refactor, reused within a Symfony setup to demonstrate how the classes can be integrated into a modern framework.  
The repository will be updated and synced with the latest improvements from the refactor so that the Symfony version reflects the most recent changes as well (soon).

## Handlers

- `\App\Handler\PermissionHandler` — represents the **original source code** provided for the task.  
  **Endpoint:** `GET /has_permission/{token}`

- `\App\Handler\PermissionHandlerV2` — the **refactored handler**, showcasing the improved design and structure.  
  **Endpoint:** `GET /v2/has_permission/{token}`

## About

There are many possible ways to approach a refactoring task like this.  
This repository reflects the path I chose, based on the time available and the aspects I decided to prioritize. Different contexts — such as deadlines, scope, or focus areas — can naturally lead to different solutions.

The aim here is not to present a “perfect” approach, but to share one practical example of applying clean code principles and framework‑agnostic design.  
I continue to refine and extend the code whenever I discover new improvements worth adding, as I enjoy the process of evolving this refactor into something even more robust and instructive.

## Original Notes

The sections that follow below this point are taken directly from the original README/content provided with the task.

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
