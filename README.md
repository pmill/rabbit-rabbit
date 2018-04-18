# pmill/rabbit-rabbit

[![Build Status](https://scrutinizer-ci.com/g/pmill/rabbit-rabbit/badges/build.png?b=master)](https://scrutinizer-ci.com/g/pmill/rabbit-rabbit/build-status/master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pmill/rabbit-rabbit/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pmill/rabbit-rabbit/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/pmill/rabbit-rabbit/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/pmill/rabbit-rabbit/?branch=master)

## Introduction

This library allows you to execute commands when RabbitMQ queues message counts match conditions.

## Requirements

This library package requires PHP 7.1 or later

## Installation

The recommended way to install is through [Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest version:

```bash
composer require pmill/rabbit-rabbit
```

# Usage

There are example usage scripts in the `examples/` folder. The following integrations can also be used:

| Integration                              | Url                                     |
|------------------------------------------|-----------------------------------------|
| Amazon ECS                               | [https://github.com/pmill/rabbit-rabbit-ecs](https://github.com/pmill/rabbit-rabbit-ecs)
| Slack                                    | [https://github.com/pmill/rabbit-rabbit-slack](https://github.com/pmill/rabbit-rabbit-slack)


# Version History

0.1.1 (16/04/2018)

*   Added unit tests

0.1.0 (12/04/2018)

*   First public release of rabbit-rabbit


# Copyright

pmill/rabbit-rabbit
Copyright (c) 2018 pmill (dev.pmill@gmail.com) 
All rights reserved.