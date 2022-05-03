<template>
  <div v-if="user" class="main-container">
      <div class="image-info">
          <div class="image">
            <img v-if="user.img" :src="`../storage/${user.img}`">
            <img v-else :src="require(`../../../public/img/${user.id}.jpg`)">
        </div>
      <div class="info-user">
          <h1>{{user.activity}}</h1>
          <h6 class="address">{{user.address}}</h6>
          <span v-for="(type,index) in user.types" :key="'type'+index" class="type">{{type.name}} <span v-if="index != user.types.length - 1"> · </span></span>
          <p>Chiude alle 22:00 · Consegna gratuita · Minimo d'ordine: 8,00 €</p>
          <p class="order"><img class="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAABs1BMVEXNzc3///8AzL5FAGT6U1oBfIiRp6f3Tlf1UVjKysrOzs7K1NTTzc7Uzc4/AGDQzc3S09EAeYY5AFw8AGTyfYf3SVIAy70zAFhAAGAA08L/UVbl5eXc3Nz29vYAgIqcLmD5i4/t7e2FcpP9SFAxAGWVpaZGAF2XqqmtzcpMzMKXzchtzMS5zcu/ucLDwMUsAFPi2+aDzMYQtrPzam9MEGrv6vE/zMGizclOHGtgzMOAzcaVg6CvpbUvboxzoqhTlJy2w8SmtLSaiqWNrrNwoafVubr2YGbim50Bk5cAtq8rSXYApqTwcnfFuM22psClkbLepqiAY5OVNWfnUGDIO1utMV1tS4E3d4LWzNvP8/Cf5+GF4Ne97uqJv8FNMXM+iJtJTH05m6VFZolLPndjKHJsO3p0TYCGaJDk+fd2e5lyhp5ykqJDuLdIj59RXoZCqq8DbYIxPXE1Mm5rtK+Ej5txa4pgTXtjtrCqlpe2jY7DhYfPen3nkJPZsLGOS3mWe6VlGWV+KWdAJG01WoO7Q2VtF2LiRVnNa26sYmuHanRacn3VWGDJd3hQc36eZW98bHeUH12+eY00AAAZtklEQVR4nO2d+38TR5LAx5Jle0avkYwtIUsKso38AD8A25iHjR+EbIgN8SYxBpKwEBuye8kGkru93bvknJDNkg2bsH/y9bz7UdXdI43I5/Zz9ctujDSa71R1VXV1dY/R968uxq99Az2X/yfsmdy9d39mJZVKrczcv3e3lz/0qxB+em9l1JOU/7+XPuzZj/0KhHdnHDRWyB/u9ejnek/YaLRaY/V63bYtyzDy0ysCng+Z6o2x9pKwQchs0xPDlaJxCaTz9Xi/F3fRI8JGq24bIVgg+Wmcz1NjD26lB4SEToRzAc/JAXuDmDRhY8yG4FzAMypAB3GskfAdJUrYGLMwPMPIzagBiazkjHoryZtKkBDXnutk9ABTqTN5wzTqyWkyKcJGXYZHTFQXMJWaLpLPm9ZYQneWDGHLkuLpjcFARovuV0wzGUUmQThmKPiM3EV9wFTqXM7/WiKM3ROOyc3TlWwcwFSqGH7RtFu/NqFaf0asQejKbITYPWN3hDr6I24US2VOIn9fydNfN+2ubLUbQi39EcmtwCAfrZ0/CUNm2Qt0NR47J1T6z1CFmJv5qN3++MEKBEmbqcfYeezolJDEPz0+MgoRFaZm2+lqu/27hykB8kyOv4hptV4v4Zg2n1E8iwCmzrXTRKrt9KMvOEZ2IPqM9ddI2LD1AY3cZYzwvkvoQq4+YIbkqKBDV1qvizCGAg3cz6RSl9KRtNuffL4SMcKX6kiN8QljKdCQRftLS1WKkQzJPz4MAkgWvpZpxXeqsQlb8fiM4ixKOHNIE7qQS48+c631LO9MQ8bYTjUuob4L9SWH59wrRxyha63ukDyLXs+0e0sY00INecb2WCT0h6Rp4VeMaamxCBtx8RxCuHboyMk9kJBYa3ncllzSbPWKMO4Q9AhxFaKE6fKWjDDeYJQTfkr/R7wgoUP4pEPCWGFDSvjpaGrl0v0P77qg9WIRc3CdEo6jhFcl4zAmopTwbrhyQkgvz06fNfL5XC4eqIzw9yjhnIIwhkuVEt6LvESw2OCSZmOQygj/gBLOqwiJS02C8D7qB1dmzpy7OE1A8zmF8cp86b9hhGlZtAgR9aKGlHAGv7uA9NKZ2Ytns0WcNI+vxeCEq3JH44uphSglTCkJfRn1hmkx5xovQ4pPLVInr7dhwOqhFqEeopRQFzAinREcEjrDJ/LZJ22QsbqvR6iFKCP8NDZhSLpy5vLF6WzRneZJPnfys0fttmiqhSeahDqIMsIPOyYMxJmrSwaiwzj6+ccCY0GatLGiRJQR3kuE0DDOoXNgl1FUZPmKPqESUUaIBwtd8SpKufy0VI+pkyusIstXYxCq4qKMcKVrwqAqWMw7isQKwClXkX+MvI4yaWNEkd3ICLsG9BbKPMnlNh8i9V8fcuXBqq9IddJGiyJHlRB27kpDocst9l67iha5PcaTX3iKrGgkbTSidDIlIbzbNeEodRvWXNmZvj97KDdWV5FlKxahfEosIUzKlfoq9EsW7bRakel4gPKwKCHs3pWe3ygWrUCFlcCPqBSZOnkOLghLROJQccIxaRTTkneeNtc3bBfS3i9QAU+uyNG4KpR6G5SwYXbvaD5aL5VKBLJYtK+W2bSl3f4SVSRaLJUhtmITWjFXpiHZntrOlDIuJFQaRRR5GViW0UDEhiJGWEcXbmPI6YGBzWulTIZAPr25Ks4hQEVC6046ggV+hLBlSqrxurJCCAc21x3ETKbZfHqzIM6VXEUy38p2Uu8y8KgIEzZMWTVeV2YcwgHXUkPIJQGy3f4DnbXOxvajISJspzChrZr0aMl/uoSBpXqMzafPOMLCEclaZwPHfalDG3UEDhkgoVPcllSQdOWrAV8CS/Uh156lKU0WnBSt6E8/RtUcEiWCdgoSOsXtYteAqe2AkFhqM2IkkJm1UJMVf6bkKXK6w0HoI0J2ChHWDdnqu7aMDlASWWoI+aU7jaCm88V8J5GQFsifAoTuAoysgKQpK6dpxKl1BtGHrB7ZdALTJSAY9wFC9ydzyo5lpcwwhJyl+pCla5udLYdgokPoLTHlknOlmKV6Uspc37ASgwScjUjofRRt89GXrwZ4ESzVY3Qg7WL8dBtEVBMGC/VdA1KuNEKcEiw1gFyPZlpdiTDJEAiDZdDuCXkjxS3VgyT5ea57SCFi8IR173MJ5N2jICGxVJgwgOyWUFAiR9gItu90n3fPwISopfqIXRPySuQIfRUmkXcLrjRihC215IaOrgl5JbKEgQpj9y0DIrpSqaUSvo1kgganRJYw7HhKIO8GXCnFyFlqqXR9I5dMvOBrNixh1E/SNeCoDJCz1FJm20goHrqIOGHYMZNE3o0OQ85SiXvZtpJM3LjEhiEMH2MCeTfmSiPEAcdSHfeSS5TPEYww6upKIO/GXSltqY57Sc48A2GmGDRhPfxIAiUMiSulLHXTTp7PYOeJFGEj8jMJ5N1SV0pB6nTOxBY6YFCEVGdeAiUMtZH6smn0wEzHQELqh7qvd6tcKS0bMRfTNMSCCCkjTSDvXolB2ANTpcw0IqSNtPu8W8OVMqaaMCNlphEh9RMJ5N1fxSNM3FQtkZAy0iTybk1XSsnURpKIkZmGhHSPcwJ5d2zAgWRNNTLTkJDu0Xm9rpRmTM5UbYGQUmECeXcsV0pJcl7V5AnpnQYJuNLPOiRMzlTD3DQgrFP/KGl61ZXYrpQSwatarsQlrHOE9AUSyLvXuyDkvao1d3Vubs60Q9GDtVhCOlYkkXd3wecIY6r2eKVMpJBePdp78uTK1lW9zkWTJWQ2/OS6BuzQldKMkVna4daaarVaKJTLFcWOGp+wxRAyO35+PVdKS2iqbLORu+io07sYRERDjIYJ5N2du1JKAlO1D/nmhuqRjhLrDCH9L8XuSxg6rvSaBqNrqrbYiaPVJm3RhIyjSSDvVrrSqYFMc0pDjyRyWPNiq5GWnfqpqSE6mtfgSqeul0oaOhxwk5z5skioY6e+qzFER5PrvnNWpcJrpUxp3dRRIjHVqG8znp36rsYQMpoE8m65K51ad5qkStvF4oYW4+k/AYQ6dlqnCJl+iO6DhdSV+vV8QkjSsQ0dxH+HNoBVD5W5jU0R0n/vdQnDX5NxCIm/MzbVhPBGTPluaFciQtaV9jLvjtbVShteLV+D8T/gTXwVlZ2aCGECeTd6r9SKUynMWSyVy0EIlXbqhQtDDBbdu1KMb4BaNYwIneEoZQQ9jYadeuHCEIJFcfbcmUtdbQhCXCkJgvSaKP2bUpcz9TFCqLJTjNAo5nK5fD5vnJ2+eO7ypZn48R9xpdzqPbukZlnocJwC+qd9WZVOjL2AaAjhMCIlQlhzRSM7fXH28pkZXcVCrpSkaSxgk7cwy8QYl1DCsnQrpjfNlxCysL5ez14kRqxgBVyp2H7RFLudEcbTw6wUKKlId7lFhDF2+/msuRwxYm/AirDAXQotNKVrwMKvBWY5p99g5LfjtFxJnJBjJbBGlrDO0gOWVyHYXHIdXNqGXM6fa6y8lbUpkd2iHRJ2Wb8rBkacI85p9gw/DMEGIYQQYvxLrZ+RiXeRM5Z6R8jA5ja5xlnRQl3CdbQ9gc9y/osj7J/4RhPRCgmT4nOvyinwOoCXCdJS7BqMy/lvnrC/9maMgqJL2NHBM4iYLCHabLkpvUk6k3sxyBP2D+a1EHtCyIyiqXW8DXFD3kQTZXLbOwJgf/+QXotYrwmRHkSfMK/oEwpczvYNgHDwhlZ/Q08IqRGEKtAhHJ2ZNRSQnsvZFoahIyMXshq1qJ4QToUWiuO5hCRwKiFdlzMBEfbXdtQO1eyJL9WwUEeafnaggiyaf4YJ+2un1Ig9ILRMWRAECF3IrAQy+xZopUQmvlYi9iDie94BC4KU/IbJZCWQOGH/xFsKRKsXhJuyIEgNQ5aQyMos3ISZ/XoEI1TmbxFhR5k3RijMBPUICSO4cy17CidU5W92DwiLXK0CJXwHmlhCuw+zJ1ArdRCl+VtEqJwBB2KJYjNiaVgoTgjtcs7uyAj7B2WIMeb4zvNwAYrm/Pz8XCBXXdkK5MqVK79X+dCA8DxICOxUt/9HBijP3yhCVcg3xxrHlUqhLJVCoVB91nTuv9lsZkpyeRskTIknYlir3w5JlYjnb1SdRnmqpWPQy3sL/GqzKDeferLW/E0g79By/vz5t13BCj0CoJkeXr0hM1Q8f6NqbcqDSd3yeN/i/gJ6DGAg/ibt9ppzjIDsABNELnIj0TIL6eGl92SIaP5G1UsVhFHr+8FhRcnoS4clZf40dm99dFiOiORvFGFDSshs0NhdhdYrAV2udaBAIjOcr7G8Q1Em35fGDDh/o9Yt5JMLbgv4rQKw6gwgnu8IkfemPmF68q9SRDB/o9aepKm3uI3/dkWHcWm0E0SeMDzYZvINCSGSv1GEkqQG2uK+fFxRu9X0Uida5K3U3gp+afK3UkQgf6PXgPGQjxxPREKH2uW010alJ7RBconzNPZ4+Cwnv5MhAvU3eh0fD4joEVOL+2q32m4/eyA92EsUPuTbTyJrGZbGfgGR6cVAw4XsmLADHbfabj9fe+ekPiUfD+0/Uc9xeHVI4m/4/I3pp8HCheL0890lndDRble/f6hrr/wMymYOmJLGfj5/Y3qiEGeqPjX7VlkrdJBU59mDt3VUyd+CzS0eymI/n7/10YSwM9U5UFovdKR9exVfKcPKKD+5sHmnLYv9bP5mM4Swq9E6+FwvdPiQ1UcPpWFSSGlM4fnJYn/tRITI9ZfCrkbzbPflvclhTUaH8nfEXjFCIS2dEy1EFvup/I3rEcZcjf31KVZOQHLq5Q+T2ogO5E0MkX/RE0Qojf1R/haEAahXn1HjzsSIhtTeb+urMZ1+hBHylRqLP43QQ5TE/jB/43r10azGyn4t1pwHRakNfjCszdh+gBHyqZdw3qInstgf5G/8fgt8iph9CyirQ4xD/9Qdjm2glugJX8Swt2BPPXyIx34vuRH2zEgmUNlvoIolxPg3zeHYhutQ7mtWOcIriJ+Wxf4RBzHMxsC9azzim/ADAxjfb+swtjEVCifu0WkpzyiJ/XkriuXg/kNeLOMCfDWAUWc4DmPD8LKgw8d4rMVj/+CNoiHuP5RWMqzsCWSNq6PhqB0sgN0kNCIa+0cuAHtI5cszoEvFGJXDEa3hCGV9+2PZFG3yDXTl7Zs+kVBRNM2+K8nq4w3HdhMBFF+3ZuFdey4iEvsn3oX2cssLbo6/6RfbPlBFyoZj+wuMkB+GlqmYZcOxn0T9FkCoXEW08rLac4zh2EZK+uKyBZB4C1oU74lkbuCZCuravmXtYIMRYsSHI1YtFl7OCaaltAx/C2iQpKZ1kFDdkiHxNxAkNhyfawcLOC1VAJLpBXK2ic4iW/ZdOSKvSHA4osGCL9KoCIdXxfTUnT/RU3f4jCEJ4ps13N+IjNBwxAv+wjI3lpb6gEsIILMOAZ8TJRHibyQL6yKkOBzbDzFC4cfQtNSVpfdgQPawL/isLymiIV93Fhm54dh+ByEcFda4JWkpmJhOeKtQdZRQr/3Lyp5SDEaBkRmObcyV8kUaOSEOyBZ5kTP35AJOGWWM7HDEjFR8k7O9j0b8yZci4Al27gsRqvKaEBGcMsogqeH4CUZ4TrRS/m2zEaA4sQgKbdJzE7X7TkgKpx6MHGMwHL/XzruFenAEKE4rajt+PZhb70TOL1WKVUSmjDLGD9LDsiKN2BNlISqUAfIrEcgZtBqIFjZlxCFrg2Q44sFCBJyHHQ2ZNfGRsLYTbIHiTy3nCbWVSKVwQ9KGF5bxbz+UsSKNUNHH0lKSbQ9xv1kLlyyExST0LGgN8VO4If7n5IzvY8FCfC0CTDjsAjI/OXIh3MQmHDwvnucdoyWa+BsPUAcxYBzSDxZgWjr8XY3/yZEbIaC44Imdya4nJIUbHNJGdCFHXmgXacC0dPi7fv4Xa9TCobjSgp2rryf2eullLQ5i/+DEX2IEiy3B0wx/OxRKCBgdECoeyY6+G0FLg5bTavljPMSJ0wigmHfTbQoRYD9HOEgDAu/wwN5voSFF43O31fLvsRAnvopBuFfANej/4OBQzgoPkoKWdNF3lPD6Eg5pKm4EvaQ/DQ7qI05oF2nEtNSd8bKEg0N523aaXucN2wbfZ4m+Z4axRtue2xrf29/fG9+a8yGLG1E7950Y/mYEUyHfSSMSDi85G4Q4Jc5t7a2mne7WpaPxqxAM+q4gSnvG1b10pVwoeKc0FfaukqeV22aagfX9zQWMEHidHHf2jj/jpQkHD50jsjypFirp40VNwshOLXt+PF1mHmW1vLrFAer7m9o/9IOFYTGAk/6EkAb8liuRlCt7y3qEgZ3a5pMykBuWHwnt3Lr+pnan2Qx6h91+YffV7SfBvNuiw2EASPnSwTtinatQua1F6Cdv9tU0mPuuNcXm9J9GtPxNzXsPGyuZ9exZQYMGc7oQNSGMAJs3gZurHEnm+JRYjoWOw6WupwAg8TdDOohDcO9+E9hxSael9IzXJxz5mXwPur3C0rIOIZlk2Hsg4GoJBCQ/91LIGEV5D/4utDGYSkvZCaH7I4MEMNPk33HmSjW9rEHYN2Y/BgGfZxBAIi/UiC+x75ZO84exRG0K3IzX+YnaT+63noJGVjjSIew7BgGf4XxEflH5m9oL9LulF9+wfWlh4j35ATulHwwBM80vQcTysQbhLtR32L4pBcxkXtXk06naj/h3f57YydOMQVrKN0GRFKr2yv9O8yn4/vn0wqKScJkFJKE+vbqa/l4BSG5T7m9qv0i++7I2caqY5Qn5ZVBnGv0q/E7zebXsNA9W2O66wr6SkEmYCuX9LZL4WZ+r+IjceU82GGt/l3z1l1p/rf+tUI1e4j3ML4ISwH9G3ry59njL1dfBMRO5K4sKQsZGy0dz7q4uzW1bMpdKPX1RXjnDbeJGMBzd7lkQcPJLypY2ginT8h5104U9BSH9OMpXHC9Hp9oK+RFHDDwETkgYd97MBkdCDv8gAr4xSUJy+KXS9eiuaedY4Tr3OLlFfbTsHoha3NTly0QpHEB4R/o1n2LiayPr1oPFJVAPkHbpJSqFoZpTKrtSwiUeUEi15YJPGV/99PPPd4hAl/slDAq1QTIc8yDgB17lnDo17KPovpcXIjN9IiM8iAzaO4opB771TiJoChcepONElRtEXr58+eLFix+J/EKvB5LhmG+LS6ABYJoKWyXqzqMequqhjHCP/lzdtGy9va+M6KRwHDX714kL3wpLoCEgpkTKQ1YaOGEjGoWVA2c+3AGgVgoXV2p/jdZa6dBMmSlFuIgTRg+iuur8d0eAUQqXHOD71GLyfPRDpeno3qOygKMcjDByuuVbzn9Pd0aYeTXSnyTixKnnkR+5YlPb4pvRvUc7UGSEUT7jabrRIWGYwiUESM0XC6aRpUbi2ZiEVDD0/qB1igAkJT+FSwCwdiIbdWYU9mybuqvS5/EIo6BSeOz9JdspYXL+praTpYqL5av1vr4WpcRsOA51CBdDR1O+4v+pY0BpChcP0KKKi5U6a1qla/6NUmFgAY8WFGFQt4qX0bDyKgFEZ4mXWhH2XHzfmKhEKlfxR5gm4ViHhG4h7efBbv2Nu8RLld6q/ugJw1ip6RPejj6zH4uwT/e8C0aazWvXrl9f394c0mtOwcRb4qVKb8HUyPcPpUwYEKNhGNw76GlCwkJY7vgIJmROwMg4RNcI0fbmxsYGyfXsXNEVtNc/DiBE2PfQfYViFPApI/UdDRwtQl/q23tfEBIp7RC0TOnp07W1NYeIIJlOgTVAKrKvTdFrFEMkWOKFCM+Se6GyUirxTpf7JITR3CmsBRCTj6xue/v5x88LziY08hDGbZFIFL1GMRjQXwGlx2FYLcys0wVuSoXB5AkmjKYW0UBstIL/N1a0r0RFnLL0FFgK8ZvOEKMlXsuM3GQZ3oEdjcLQSGFCaoZf5pdyHNh5ukqlewSTtNdfAhjt0KZe5RFM4FmhihjR+AIJFyll7wH/TtXhCuqz3wOxitJzZmDAoTy1SH8cBcR94LZuUbHQmzKghHQRo3JL+Ndj+ko6r3wJEK2dmFGDAjSNFjO9PRBuiykPVsI/w4R0zWqBNwgasLof55wwKxtbQkA3TaOscIm/59sLFGDkPxDCRfrT7JJjY595VJp+pksxbc+zRGZKFbVdWWZui+ZHam3MlrHK49DdNG4zxXO9l/Z0zWe0gidPl3yXIkNdZm8rvUDZMEJ4wKxaFMp7uwRyeXePO0KhPPca+Og2IPrJVyurtw6IbhdvPeZv65hCwWreXK9OoVxxhFvyJl5ozEjyEGIFH3ny9PBJV8uVhfJCpcz12RZW6a9ghMsaZ0F4Q6GXjKbBt3HxXVKQsDEcXXvaXVBdqLrkJxZjVm8YRT6tJ7/ABhJ8hfS26mQW6lG17OQZTasF3daB6snzkVK2yi29VrXCtB816maip4KbdZCvj4t7ghSEVEBCKL1WoSD0V7WSgjRNG+ii1Lqt8qGQR8sI+w7Q83UqR0BG3tcYs7uGNE1rTHJ0kyO72ClchYVj8dNSwr4GfKSX0FlFSatudExpOtpT4DmyeAj5iELlsdi3pyJ0j7viGQuVPehK1HNxVBmX0nSU11LTeXIrzcfmcmUfvisVIbGJowUqpJLQr+ALKOuWqcnpfKyuT+ff1n4lDPUk8heAvktP1ITEKG4fFdyUplJe2rulYUWBNFqE0wEASU3vH2wCF+Oa1NV3jw+J6irl9NFtcS4Vig6hc7XFg93d3UXIvai/S0DH6nXbdko5HpVl2/V6faxDNFqWicg/oUn4f1j+9Qn/FxzxRFatDwDKAAAAAElFTkSuQmCC" alt=""> 
            Ordina il tuo piatto preferito a casa tua da {{user.activity}} grazie alla consegna a domicilio di Deliveroo.
          </p>
      </div>
    </div>
    <hr>

    <h1>NOVITA' E PROMOZIONI</h1>
    <div class="d-flex justify-content-between plates-and-cart">
        <div class="ms_row_plate row row-cols-1 row-cols-xl-2">
            <div class="col" v-for="(plate,index) in user.plates" :key="'plate'+index">
                <div @click="showFocusCard(plate)" class="card-plate-box">
                    <CardPlate :plate="plate"/>
                </div>
            </div>
        </div>

        <div class="d-lg-none">
        <div v-if="!showCart" @click="showCart = true" class="button-open-types">
          <i class="fa-solid fa-cart-shopping"></i>
        </div>
        <div @click="showCart = false" v-show="showCart" class="hidden-close-sub create"></div>   
            <CartBox @add="add" v-if="showCart" :cart="cart" :prevUser="prevUser" :user="user" :tot="tot" />
      </div>

      <div class="d-none d-lg-block">
        <CartBox @add="add" :cart="cart" :prevUser="prevUser" :user="user" :tot="tot" />
      </div>
        
    </div>

    <div @click="focusVisibility = null" v-show="focusVisibility" class="hidden-close-sub create"></div>   
    <FocusCard @add="add" v-if="focusVisibility" :user="user" :prevUser="prevUser" :prevOrder="prevOrder" :plate="focusVisibility"/>
  </div>
</template>

<script>
import CardPlate from '../common/CardPlate.vue';
import CartBox from '../common/CartBox.vue';
import FocusCard from '../common/FocusCard.vue';

export default {
    name:"MainPage",
    data(){
      return{
          showCart: false,
          user : null,
          focusVisibility : null,
          cart: null,
          tot: null,
      }
    },
    props:{
        prevOrder: Array,
        prevUser: Object,
    },
    components: { 
        FocusCard,
        CardPlate,
        CartBox,
    },
    created(){
        if(this.$route.params.user){
            this.user = this.$route.params.user;
            this.removePlate();
        } else
            this.getUser();

        if(this.prevOrder)
            if(this.user && this.prevUser)
                if(this.user.id == this.prevUser.id){
                    this.cart = this.prevOrder;
                    this.tot = JSON.parse(localStorage.getItem('storedData1'));
                }
    },
    watch:{
        focusVisibility(test){
            console.log(this.focusVisibility,'qua');
            if(this.focusVisibility)
                document.getElementById('remove-all-scroll').style.overflow="hidden";
            else
                document.getElementById('remove-all-scroll').style.overflow="unset";
        }
    },
    methods:{
        oneMore(i){
            console.log('sono in onemore');
            this.cart[i].quantity++;
            this.add(this.cart , true);
        },
        oneLess(i){
            console.log('sono in oneless');
            this.cart[i].quantity--;
            if(this.cart[i].quantity == 0)
                this.cart.splice(i,1);

            if(this.cart.length <= 0){
               // this.user = null;
                this.cart = null;
                this.tot = null;
            }
                this.add(this.cart , true);
        },
        add(order , noEmit){
            if(!noEmit){
                this.cart = order;
                this.tot = null;

                for(let i=0; i < order.length; i++)
                    this.tot += order[i].plate.price * order[i].quantity;

            /*if(this.user && this.prevUser)
                if(this.prevUser.id!= this.user.id)*/
                    //alert("sei sicuro di volere cancellare il vecchio ordine?");

                this.$emit('add',this.tot , this.user , order);
            } else{
                console.log('sono in add ma in else');
                this.tot = null;

            if(this.cart)
                for(let i=0; i < this.cart.length; i++)
                    this.tot += this.cart[i].plate.price * this.cart[i].quantity;

            /*if(this.user && this.prevUser)
                if(this.prevUser.id!= this.user.id)
                    this.createNewCartShow = true;*/
                    //alert("sei sicuro di volere cancellare il vecchio ordine?");

                if(this.user && this.tot)
                    this.$emit('add',this.tot , this.user , this.cart);
                else
                    this.$emit('add',this.tot , null , this.cart);
            }

            this.focusVisibility = null;
        },
        showFocusCard(plate){
            this.focusVisibility = plate;
        },
        removePlate(){
            let plates = this.user.plates;
            for(let i=0; i<plates.length; i++){
                if(plates[i].visible == 0){
                    //console.log('rimuovo',this.user.plates[i]);
                    this.user.plates.splice(i,1);
                }
            }
        },
        getUser(){
            console.log('axios');
            axios.get('/api'+this.$route.path)
                .then((response) => {
            // handle success
                this.user = response.data;
                if(!this.user)
                    this.$router.push({
                        name:"main"
                    });
                console.log(response.data);
                this.removePlate();
                this.load=true;
                if(this.user && this.prevUser){
                    if(this.user.id == this.prevUser.id){
                        this.user = JSON.parse(localStorage.getItem('storedData2'));
                        this.removePlate();
                        this.cart = JSON.parse(localStorage.getItem('storedData3'));
                        this.tot = JSON.parse(localStorage.getItem('storedData1'));
                    }
                }
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            });
        }
    },
}
</script>

<style lang="scss" scoped>
@import '../../sass/front.scss';
.main-container{
    width: 90%;
    margin: 0 auto;
}

.button-open-types{
  position: fixed;
  bottom: 15px;
  right: 10px;
  height: 50px;
  z-index: 9999;
  opacity: 0.85;
  display: flex;
  width: 50px;
  font-size: 1.9em;
  background-color: $primary_color;
  justify-content: center;
  border-radius: 50%;
  align-items: center;

  &:hover{
    opacity: 1;
  }
}

.hidden-close-sub{
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
}

.hidden-close-sub.create{
  z-index: 9998;
  background-color: rgba(0, 0, 0, 0.5);
}

.plates-and-cart{
    max-height: 400px;
    margin-bottom: 25px;
}

.ms_row_plate {
    width: 100%;
    max-height: 380px;
    overflow-y: auto;
    padding: 0 10px;

    &::-webkit-scrollbar {
        width: 0px;
    }
}

.image-info{
    display: flex;
    margin-top: 30px;

    .image{
        margin-right: 30px;
        width: 100%;
        max-width: 400px;
        height: 225px;
        overflow: hidden;
        justify-content: center;
        display: flex;

        img{
            min-width: 100%;
            min-height: 100%;
            flex-shrink: 0;
        }
    }

    

    .info-user{
        width: 40%;

        h1{
        font-weight: bold;
        }

        .type{
            margin-bottom: 10px;
        }

        .address{
            font-size: 18px;
            font-style: italic;
        }
        .order{
        font-size: 13px;
        font-style: italic;

        img{
            width: 25px;
            margin-right: 5px;
        }
        }
    }

}

.card-plate-box{
    cursor: pointer;
}

@media screen and (max-width: 576px) {
    .img{
        width: 80%;
        min-height: 250px;
        height: auto;
        border-radius: 20px;
    }
    
    .image-info{
        flex-direction: column;
        justify-content: center;
        align-items: center;
        
        .image{
            margin-right: 0!important;
        }
    }

    .info-user{
        width: 70%!important;
        margin-top: 20px;
    }
}

    
</style>