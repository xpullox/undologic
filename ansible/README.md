#DEPLOY

##MANUAL OVERRIDE (Perform the steps yourself)
You need to navigate to the same folder as ansible to run this command (eg cd ansible)

`ansible-playbook site.yml --verbose --diff -i hosts-production --tags "manual"`

NOTE: If you change branches you MUST change github_active_dir in 'site.xml' to the new branch name

TROUBLESHOOTING: If you do NOT have ansible installed install it with brew
```angular2
brew install ansible
```

##LIVE ONLY
ansible-playbook site.yml --verbose --diff -i hosts-production --tags "staging,testing,launch,cleanup"






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

