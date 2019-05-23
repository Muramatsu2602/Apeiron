<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Animação</title>
    <script src="three.js"></script>
</head>
<body bgcolor="#212529">
    <canvas id="myCanvas"></canvas>
    <script>
           
        //RENDERER
        var renderer = new THREE.WebGLRenderer({canvas: document.getElementById('myCanvas'), antialias: true});
        renderer.setClearColor("#212529");
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.setSize(window.innerWidth-20,window.innerHeight-20);

        //CAMERA
        var camera = new THREE.PerspectiveCamera(100, window.innerWidth / window.innerHeight, 0.1, 1500);
        // var camera = new THREE.OrthographicCamera(window.innerWidth / -2, window.innerWidth / 2, window.innerHeight / 2, window.innerHeight / -2, 0.1, 3000);

        //SCENE
        var scene = new THREE.Scene();

        //LIGHTS
        var light = new THREE.AmbientLight(0xffffff, 0.5);
        scene.add(light);
        
        var light1 = new THREE.PointLight(0xffffff, 0.5);
        scene.add(light1);

        //OBJECT
        var geometry = new THREE.CubeGeometry(100, 100, 100);
        var material = new THREE.MeshLambertMaterial({color: "ffffff"});
        var mesh = new THREE.Mesh(geometry, material);
        mesh.position.set(-300, 200, -1000);

         //OBJECT
        var geometry = new THREE.CubeGeometry(100, 100, 100);
        var material = new THREE.MeshLambertMaterial({color: "ffffff"});
        var mesh2 = new THREE.Mesh(geometry, material);
        mesh2.position.set(-300, 400, -1000);
        
        //OBJECT
        var geometry = new THREE.CubeGeometry(100, 100, 100);
        var material = new THREE.MeshLambertMaterial({color: "ffffff"});
        var mesh3 = new THREE.Mesh(geometry, material);
        mesh3.position.set(100, 200, -1000);

         //OBJECT
        var geometry = new THREE.CubeGeometry(100, 100, 100);
        var material = new THREE.MeshLambertMaterial({color: "ffffff"});
        var mesh4 = new THREE.Mesh(geometry, material);
        mesh4.position.set(100, 0, -1000);
        
        
        
        //OBJECT
        var geometry = new THREE.CubeGeometry(100, 100, 100);
        var material = new THREE.MeshLambertMaterial({color: "ffffff"});
        var mesh5 = new THREE.Mesh(geometry, material);
        mesh5.position.set(100, 500, -1000);

         //OBJECT
        var geometry = new THREE.CubeGeometry(100, 100, 100);
        var material = new THREE.MeshLambertMaterial({color: "ffffff"});
        var mesh6 = new THREE.Mesh(geometry, material);
        mesh6.position.set(300, 0, -1000);
        
        
        //OBJECT
        var geometry = new THREE.CubeGeometry(100, 100, 100);
        var material = new THREE.MeshLambertMaterial({color: "ffffff"});
        var mesh7 = new THREE.Mesh(geometry, material);
        mesh7.position.set(550, -600, -1000);
        
        //OBJECT
        var geometry = new THREE.CubeGeometry(100, 100, 100);
        var material = new THREE.MeshLambertMaterial({color: "ffffff"});
        var mesh8 = new THREE.Mesh(geometry, material);
        mesh8.position.set(-580, -200, -1000);
        
        
        scene.add(mesh,mesh2,mesh3,mesh4,mesh5,mesh6,mesh7,mesh8);


        //RENDER LOOP
        requestAnimationFrame(render);

        function render() {
            mesh.rotation.x += 0.03;
            mesh.rotation.y += 0.03;
            mesh2.rotation.x += 0.03;
            mesh2.rotation.y += 0.03;
            mesh3.rotation.x += 0.03;
            mesh3.rotation.y += 0.03;
            mesh4.rotation.x += 0.03;
            mesh4.rotation.y += 0.03;
            mesh5.rotation.x += 0.03;
            mesh5.rotation.y += 0.03;
            mesh6.rotation.x += 0.03;
            mesh6.rotation.y += 0.03;
            mesh7.rotation.x += 0.03;
            mesh7.rotation.y += 0.03;
            mesh8.rotation.x += 0.03;
            mesh8.rotation.y += 0.03;
            renderer.render(scene, camera);
            requestAnimationFrame(render);
        }
        
    </script>
                                     
</body>
</html>