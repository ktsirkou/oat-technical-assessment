[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.2-8892BF.svg?style=flat-square)](https://php.net/)

# Introduction

The project is technical assessment for oat.

# How to setup 

## Prerequisites 

1. PHP7.2
2. Composer
3. Docker && Docker composer

## Run locally

1. Clone the repository
2. Execute composer `compoer install`
3. Run command `docker-composer up -d` from the root directory of the  project. This make take several minutes.
4. The api should be accessible on localhost:81

5. (optional) you can setup on your `hosts` file the `127.0.0.1 tao.docker` so the api will be
also available on this url.

# Changing data source

The sources are located under `resources` path. For now we have
the json and csv data sources. Default data source is the json file.
To switch sources we only need to update related configuration option found on
`config/services.yaml`. See below

````
    ...
    
    # by updating the following the CsvUserRepository and resourceType csv we load data from different source format
    #the rest of the project remains the same.
    kstirkou.default.user_repository:
        class: kstirkou\OAT\Repository\JsonUserRepository
        public: false
        arguments:
            $resourceType: 'json'

#    kstirkou.default.user_repository:
#        class: kstirkou\OAT\Repository\CsvUserRepository
#        public: false
#        arguments:
#            $resourceType: 'csv'

    ...
````

# Next steps and Improvements.

1. Support SSL
2. Better validation on query params
3. More efficient filtering, and perhaps adding cache
4. Proper logging, (using [sentry](https://sentry.io/welcome))


# Check the api online (only http)
- [Get users](http://oat-tech-assesment.us-east-2.elasticbeanstalk.com/v1/users)  
- [Get single User](http://oat-tech-assesment.us-east-2.elasticbeanstalk.com/v1/users/clarksusan)

---
![License](https://poser.pugx.org/pugx/badge-poser/license.svg)