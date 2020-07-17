Composer Yaml
#############

|Packagist| |GitLab| |GitHub| |Bitbucket| |Gitea|

**The project is abandoned due to lack of interest**

(Almost) real support for yaml in Composer for your local project!
As easy as ``composer yaml update``!

Installation
============

Global installation is required

.. code-block::

    composer global require sandfoxme/composer-yaml

Plugins require ``composer.json`` to initialize.
Obviously, without ``composer.json`` in the project you need global ``composer.json`` to initialize.

Commands
========

``composer yaml``
-----------------

The main proxy command that allows usage of YAML config for composer.
Your config should be named ``composer.yml`` or ``composer.yaml``

Prefix any command you want to run with ``yaml``:

* ``composer yaml install``
* ``composer yaml update``
* Works with plugins: ``composer yaml viz``

.. important::
    The proxy command silently creates ``composer.json`` and resets the Composer to use it and then deletes it afterwards.
    So any command that tries to modify ``composer.json`` will have no effect because the updated file will be removed.
    Therefore don't expect ``composer yaml require`` and ``composer yaml init`` and such to work.

``composer yaml:create``
------------------------

Create ``composer.yml`` from existing ``composer.json``

--input, -i     Override input file name (default is composer.json)
--output, -o    Override output file name (default is composer.yml)

``composer yaml:dump``
----------------------

Create composer.json from composer.yml

--input, -i     Override input file name (default is to try both ``composer.yml`` and ``composer.yaml``)
--output, -o    Override output file name (default is composer.json)

License
=======

The library is available as open source under the terms of the `MIT License`_.
See LICENSE.md

.. _MIT License:  https://opensource.org/licenses/MIT

.. |Packagist|  image:: https://img.shields.io/packagist/v/sandfoxme/composer-yaml.svg
   :target:     https://packagist.org/packages/sandfoxme/composer-yaml
.. |GitHub|     image:: https://img.shields.io/badge/get%20on-GitHub-informational.svg?logo=github
   :target:     https://github.com/arokettu/composer-yaml
.. |GitLab|     image:: https://img.shields.io/badge/get%20on-GitLab-informational.svg?logo=gitlab
   :target:     https://gitlab.com/sandfox/composer-yaml
.. |Bitbucket|  image:: https://img.shields.io/badge/get%20on-Bitbucket-informational.svg?logo=bitbucket
   :target:     https://bitbucket.org/sandfox/composer-yaml
.. |Gitea|      image:: https://img.shields.io/badge/get%20on-Gitea-informational.svg
   :target:     https://sandfox.org/sandfox/composer-yaml
