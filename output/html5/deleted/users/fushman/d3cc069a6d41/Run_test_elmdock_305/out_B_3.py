# axes plot script
from pymol.cgo import *
from pymol import cmd
from pymol.vfont import plain
#create the axes object, draw axes with cylinders colored red (Dx), green (Dy), blue (Dz)

obj = [
   CYLINDER, -18.08, 1.19, 5.42, -41.00, -2.49, -28.71, 0.2, 1.0, 1.0, 1.0, 1.0, 0.0, 0.,
   CYLINDER, -24.82, 18.80, -17.36, -34.57, -19.76, -6.65, 0.2, 1.0, 1.0, 1.0, 0., 1.0, 0.,
   CYLINDER, -13.59, -7.58, -22.07, -48.43, 7.29, -0.26, 0.2, 1.0, 1.0, 1.0, 0., 0.0, 1.0,
   ]

# then we load it into PyMOL

cmd.load_cgo(obj,'out_B_3')
