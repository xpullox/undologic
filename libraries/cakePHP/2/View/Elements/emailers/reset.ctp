<h3>
    Password Create / Reset
</h3>

<p>
    In order to create / reset your password you can either:
</p>
<p>
1-> <a href="<?= $domain; ?>reset/<?= $hash; ?>">click here to use the direct link</a>
</p>
<p>
OR
</p>
<p>
2-> copy and paste this key:<br/>
<?= $hash; ?><br/>
and navigate to <?= $domain; ?>reset<br/>
to complete the reset
</p>

<p>
    An email reset was initiated from <?= $domain; ?>. If you did not
    initiate this request disregard this email and no changes will
    be made to your account.
</p>
