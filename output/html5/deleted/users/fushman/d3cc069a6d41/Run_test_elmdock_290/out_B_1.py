# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -1.66, 3.57, 13.32, -25.75, -6.81, -18.49, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -11.57, 17.72, -10.04, -15.37, -20.36, 5.27, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, 5.41, -8.27, -14.41, -29.84, 4.31, 8.17, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_1')
