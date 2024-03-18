FROM internetsystemsconsortium/bind9:9.18

ADD bindconf/named.conf.options /etc/bind/named.conf.options
ADD bindconf/named.conf.local /etc/bind/named.conf.local
ADD bindconf/l1-9.zone /etc/bind/l1-9.zone
RUN chown -R bind:bind /etc/bind/

CMD ["/usr/sbin/named", "-g", "-c", "/etc/bind/named.conf", "-u", "bind"]

