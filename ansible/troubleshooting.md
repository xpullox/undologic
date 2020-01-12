#Troubleshooting

#### If you get errors about 'authentication or permission failure' BUT you are able to SSH

###### UNREACHABLE! => {"changed": false, "msg": "Authentication or permission failure. In some cases, you may have been able to authenticate and did not have permissions on the target directory. Consider changing the remote tmp path in ansible.cfg

RESOLUTION: create a .ansible.cfg file in your home dir

```
[defaults]
remote_tmp = /tmp/.ansible-${USER}/tmp
```

#### Failing to checkout

RESOLUTION: Ensure you created *client* directory in test subdomain

RESOLUTION: Ensure you give permission to the project from the github read only user

