# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, 64.53, -65.91, -14.53, 28.99, -76.37, 0.19, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, 43.82, -85.13, -23.40, 49.17, -57.27, 9.33, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 61.03, -95.22, 10.99, 32.34, -47.88, -24.62, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_ani')
